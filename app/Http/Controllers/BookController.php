<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    //public function index(Request  $request)
    {
        //$request->session()-> flush();
        $books = Book::all();
        return view('book', ['books' => $books]);
    }

    public function add()
    {
        return view('book-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255'
        ]);

        $newName = '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $book = Book::create($request->all());
        return redirect('books')->with('status', 'Book Added Successfully!');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book-edit', ['book' => $book]);
    }

    public function update(Request $request, $slug)
    {
        $newName = '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }   

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        return redirect('books')->with('status', 'Book Updated Successfully!');
    }

    public function delete($slug)
    {   
        $book = Book::where('slug', $slug)->first();
        return view('book-delete', ['book' => $book]);
    }

    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('books')->with('status', 'Book Deleted Successfully!');
    }
}
