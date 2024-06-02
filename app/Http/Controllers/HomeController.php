<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function storeReview(Request $request, $id){
        // dd($request);
        // dd($id);

        $validator = Validator::make($request->all(),[
            'review' => 'required | min:10',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            // dd($validator);
            return redirect()->route('book.detail', $id)->withErrors($validator)->withInput();
        }
    }
}
