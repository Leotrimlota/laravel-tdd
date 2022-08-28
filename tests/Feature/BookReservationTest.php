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
    public function test_a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
                "title" => "Cool Book",
                "author" => "Victor"
            ]
        );

        $response->assertOk();
        $this->assertCount(1,Book::all());
    }

    public function test_a_title_is_required()
    {
        $response = $this->post('/books', [
                "title" => '',
                "author" => "Victor"
            ]
        );

        $response->assertSessionHasErrors('title');
    }

    public function test_a_author_is_required()
    {
        $response = $this->post('/books', [
                "title" => 'Cool Book',
                "author" => ""
            ]
        );

        $response->assertSessionHasErrors('author');
    }

    public function test_a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
                "title" => 'Cool Book',
                "author" => "Victor"
            ]
        );

        $book = Book::first();
        $response = $this->patch("/books/{$book->id}",[
            'title'=>'New Title',
            'author'=>'New Author'
        ]);

        $this->assertEquals("New Title",Book::first()->title);
        $this->assertEquals("New Author",Book::first()->author);
    }
}
