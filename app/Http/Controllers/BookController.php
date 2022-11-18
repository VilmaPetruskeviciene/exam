<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', [
            'books' => Book::orderBy('title')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'categories' => Category::orderBy('title')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'ISBN' => 'required|numeric|min:3|max:10000',
            'photo.*' => 'sometimes|required|mimes:jpg|max:2000'
        ]);

        Book::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'ISBN' => $request->ISBN,
            'pages' => $request->pages,
            'category_id' => $request->category_id,
        ])->addImages($request->file('photo'));
        return redirect()->route('b_index')->with('ok', 'All good');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::orderBy('title')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'ISBN' => 'required|numeric|min:3|max:10000',
            'photo.*' => 'sometimes|required|mimes:jpg|max:2000'
        ]);

        $book->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'ISBN' => $request->ISBN,
            'pages' => $request->pages,
            'category_id' => $request->category_id,
        ]);
        $book
        ->removeImages($request->delete_photo)
        ->addImages($request->file('photo'));
        return redirect()->route('b_index')->with('ok', 'All good');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->getPhotos()->count()) {
            $delIds = $book->getPhotos()->pluck('id')->all();
            $book->removeImages($delIds);
        }
        $title = $book->title;
        $book->delete();
        return redirect()->route('b_index')->with('ok', "$title gone!");
    }
}
