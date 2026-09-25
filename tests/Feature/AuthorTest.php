<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_fetch_authors(): void
    {
        $response = $this->get('/api/authors');

        $response->assertStatus(200);
    }

    public function test_can_create_author(): void
    {
        $payload = [
            "name" => "Firstname Lastname",
            "birth_date" => "2012-07-04",
        ];

        $response = $this->postJson('/api/authors', $payload);
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => "Firstname Lastname"]);
    }

    public function test_can_fetch_single_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->getJson("/api/authors/{$author->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $author->id,
                'name' => $author->name,
            ]);
    }

    public function test_can_validate_create_author_no_name(): void
    {
        $payload = [
            "name" => "",
            "birth_date" => "2012-07-04",
        ];

        $response = $this->postJson('/api/authors', $payload);
        $response->assertStatus(422);
    }

    public function test_can_validate_create_author_long_name(): void
    {
        $test_string = str_repeat("s", 256);
        $payload = [
            "name" => $test_string,
            "birth_date" => "2012-07-04",
        ];

        $response = $this->postJson('/api/authors', $payload);
        $response->assertStatus(422);
    }

    public function test_can_validate_create_author_no_date(): void
    {
        $payload = [
            "name" => "Test",
            "birth_date" => "",
        ];

        $response = $this->postJson('/api/authors', $payload);
        $response->assertStatus(422);
    }

    public function test_can_update_author(): void
    {
        $author = Author::factory()->create([
            'name' => 'Original Name',
            'birth_date' => '1990-01-01',
        ]);

        $payload = [
            'name' => 'Updated Name',
            'birth_date' => '1995-05-05',
        ];

        $response = $this->putJson("/api/authors/{$author->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => 'Updated Name',
            'birth_date' => '1995-05-05',
        ]);
    }

    public function test_can_validate_update_author_invalid_payload(): void
    {
        $author = Author::factory()->create();

        $payload = [
            'name' => '',
            'birth_date' => 'invalid-date',
        ];

        $response = $this->putJson("/api/authors/{$author->id}", $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'birth_date']);
    }

    public function test_can_delete_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/api/authors/{$author->id}");

        // Adjust status code depending on whether your API returns 200 or 204
        $response->assertStatus(200);

        $this->assertDatabaseMissing('authors', [
            'id' => $author->id,
        ]);
    }
}
