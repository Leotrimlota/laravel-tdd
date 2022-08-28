<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $response = $this->post('/books', [
                "title" => "Cool Book",
                "author" => "Victor"
            ]
        );

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
                "title" => '',
                "author" => "Victor"
            ]
        );

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
                "title" => 'Cool Book',
                "author" => ''
            ]
        );

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->post('/books', [
                'title' => 'Cool Book',
                'author' => 'Victor'
            ]
        );

        $book = Book::first();
        $this->patch("/books/{$book->id}", [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertEquals("New Title", Book::first()->title);
        $this->assertEquals("New Author", Book::first()->author);
    }

}
