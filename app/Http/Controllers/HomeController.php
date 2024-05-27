<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $books = Book::orderBy('created_at', 'desc')->where('status', 1)->paginate(8);
        return view('home',[
            'books' => $books,
        ]);    
    }
}
