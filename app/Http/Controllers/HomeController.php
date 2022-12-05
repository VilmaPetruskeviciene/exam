<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;


class HomeController extends Controller
{
    public function homeList(Request $request)
    {
        // Filter, Search
        if ($request->cat) {
            $books = Book::where('category_id', $request->cat);
        }
        else if ($request->s) {
            $search = explode(' ', $request->s);
            if (count($search) == 1) {
                $books = Book::where('title', 'like', '%'.$request->s.'%');
            } 
            else {
                $books = Book::where('title', 'like', '%'.$search[0].' '.$search[1].'%')
                ->orWhere('title', 'like', '%'.$search[1].'%'.$search[0].'%')
                ->orWhere('title', 'like', '%'.$search[0].'%')
                ->orWhere('title', 'like', '%'.$search[1].'%');
            }
        }
        else {
            $books = Book::where('id', '>', 0);
        }

        // Sort
        if ($request->sort == 'rate_asc') {
            $books->orderBy('rating');
        }
        else if ($request->sort == 'rate_desc') {
            $books->orderBy('rating', 'desc');
        }
        else if ($request->sort == 'title_asc') {
            $books->orderBy('title');
        }
        else if ($request->sort == 'title_desc') {
            $books->orderBy('title', 'desc');
        }

        return view('home.index', [
            'books' => $books->paginate(5)->withQueryString(),
            'categories' => Category::orderBy('title')->get(),
            'cat' => $request->cat ?? '0',
            'sort' => $request->sort ?? '0',
            'sortSelect' => Book::SORT_SELECT,
            's' => $request->s ?? '',
        ]);
    }

    public function rate(Request $request, Book $book)
    {
        $book->rating_sum = $book->rating_sum + $request->rate;
        $book->rating_count ++;
        $book->rating = round(($book->rating_sum / $book->rating_count), 2);
        $book->save();
        return redirect()->back();
    }

}
