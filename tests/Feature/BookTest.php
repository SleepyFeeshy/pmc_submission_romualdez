<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use App\Models\Book;
use Database\Seeders\DatabaseSeeder;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_fetch_books(): void
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200);
    }

    public function test_can_fetch_single_book(): void
    {
        $author = Author::factory()->create();
        $book = Book::factory()->create(['author_id' => $author->id]);

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $book->id,
                'title' => $book->title,
            ]);
    }

    public function test_can_create_book(): void
    {
        $author = Author::factory()->create();
        $payload = [
            "title" => "Firstname Lastname",
            "author_id" => $author->id,
            "published_date" => "2012-07-04",
        ];
        $response = $this->postJson('/api/books', $payload);
        $response->assertStatus(201)
            ->assertJsonFragment(['title' => "Firstname Lastname"]);
    }

    public function test_can_validate_create_book_no_name(): void
    {
        $author = Author::factory()->create();

        $payload = [
            "title" => "",
            "author_id" => $author->id,
            "published_date" => "2012-07-04",
        ];
        $response = $this->postJson('/api/books', $payload);
        $response->assertStatus(422);
    }

    public function test_can_validate_create_book_invalid_author(): void
    {
        $payload = [
            "title" => "dsfadf",
            "author_id" => "",
            "published_date" => "2012-07-04",
        ];
        $response = $this->postJson('/api/books', $payload);
        $response->assertStatus(422);
    }

    public function test_can_validate_create_title_long_name(): void
    {
        $author = Author::factory()->create();

        $test_string = str_repeat("s", 256);
        $payload = [
            "title" => $test_string,
            "author_id" => $author->id,
            "published_date" => "2012-07-04",
        ];

        $response = $this->postJson('/api/books', $payload);
        $response->assertStatus(422);
    }

    public function test_can_validate_create_book_no_date(): void
    {
        $author = Author::factory()->create();

        $payload = [
            "title" => "Test",
            "author_id" => $author->id,
            "published_date" => "",
        ];

        $response = $this->postJson('/api/books', $payload);
        $response->assertStatus(422);
    }

    public function test_can_update_book(): void
    {
        $author = Author::factory()->create();
        $newAuthor = Author::factory()->create();
        $book = Book::factory()->create([
            'author_id' => $author->id,
            'title' => 'Original Title',
            'published_date' => '2020-01-01',
        ]);

        $payload = [
            'title' => 'Updated Title',
            'author_id' => $newAuthor->id,
            'published_date' => '2023-05-15',
        ];

        $response = $this->putJson("/api/books/{$book->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated Title']);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Updated Title',
            'author_id' => $newAuthor->id,
            'published_date' => '2023-05-15',
        ]);
    }

    public function test_can_validate_update_book_invalid_payload(): void
    {
        $author = Author::factory()->create();
        $book = Book::factory()->create(['author_id' => $author->id]);

        $payload = [
            'title' => '',
            'author_id' => 99999, // Non-existent author
            'published_date' => 'not-a-date',
        ];

        $response = $this->putJson("/api/books/{$book->id}", $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'author_id', 'published_date']);
    }

    public function test_can_delete_book(): void
    {
        $author = Author::factory()->create();
        $book = Book::factory()->create(['author_id' => $author->id]);

        $response = $this->deleteJson("/api/books/{$book->id}");

        // Use 200 or 204 based on what your API controller returns on delete
        $response->assertStatus(200);

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
}
