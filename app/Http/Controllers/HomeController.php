<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $book = Book::with(['reviews.user','reviews' => function($query){
            $query->where('status',1);
        }])->findOrFail($id);

        // dd($book);
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
            return redirect()->route('book.detail', $id)->withErrors($validator)->with('error', 'check the credentials');
        }

        $reviewCount = Review::where('user_id', Auth::user()->id)->where('book_id', $id)->count();

        if ($reviewCount > 0) {
            # code...
            // dd("greater count");
            return redirect()->route('book.detail', $id)->with('error', 'You have already reviewed the book.');
        }

        $review = new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->book_id = $id;
        $review->save();

        return redirect()->route('book.detail', $id)->with('success', 'review submitted successfully');
    }
}
