<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //

    public function store()
    {
        Book::create($this->validateData());
    }

    public function update(Book $book)
    {
        $book->update($this->validateData());
    }

    /**
     * @return array
     */
    public function validateData()
    {
        return \request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
