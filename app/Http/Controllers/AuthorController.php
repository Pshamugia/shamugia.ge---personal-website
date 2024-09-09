<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function create_author()
    {
        return view('admin.create_author');
    }
    // Store the new author in the database
    public function store_author(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ]);

        Author::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);

        return redirect()->route('admin.create.author')->with('success', 'Author created successfully!');
    }
}
