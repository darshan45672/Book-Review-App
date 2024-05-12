<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        return view('books.list');
    }

    public function create(){
        return view('books.createBook');
    }

    public function store( Request $request){

        $rules = [
            'title' => 'required|min:3',
            'author' => 'required | min:3',
            'status' => 'required',
        ];

        if(!empty($request->image)){
            $rules['image'] = 'mimes:jpeg,jpg,png,gif|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            # code...
            return redirect()->route('books.create')->withInput()->withErrors($validator);
        }

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->status = $request->status;
        $book->save();

        return redirect()->route('books.index')->with('success', "Books added successfully!");
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
