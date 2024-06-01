<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        $books = Book::orderBy('created_at', 'desc');

        if (!empty($request->keyword)) {
            # code...
            $books->where('title', 'like', '%'.$request->keyword.'%');
        }

        $books = $books->where('status', 1)->paginate(8);

        return view('home',[
            'books' => $books,
        ]);    
    }

    public function showDetail($id){
        $book = Book::findOrFail($id);

        if ($book->status == 0) {
            # code...
            abort(404);
        }

        $relatedBooks = Book::where('status', 1)->where('id','!=',$id)->take(3)->inRandomOrder()->get();
        // dd($relatedBooks);  

        return view('bookDetials',[
            'book' => $book,
            'relatedBooks' => $relatedBooks,
        ]);
    }
}
