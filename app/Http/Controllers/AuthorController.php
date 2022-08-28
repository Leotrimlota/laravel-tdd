<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store()
    {
        $author = Author::create(
           \request()->only(['name','dob'])
        );
//        return redirect($book->path());

    }

    public function validateData()
    {
        return \request()->validate([
            'title' => 'required',
            'dob' => 'required'
        ]);
    }
}
