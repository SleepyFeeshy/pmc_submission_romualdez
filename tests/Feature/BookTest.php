<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
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
        $test_string = str_repeat("s", 256);
        $payload = [
            "title" => $test_string,
            "author_id" => "1",
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
}
