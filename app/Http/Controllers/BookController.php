<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{
    public function index( Request $request)
    {
        $books = Book::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            # code...
            $books->where('title','like','%'.$request->keyword.'%');
        }
       $books = $books->paginate(10);

        return view('books.list',[
            'books' => $books,
        ]);
    }

    public function create()
    {
        return view('books.createBook');
    }

    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|min:3',
            'author' => 'required | min:3',
            'status' => 'required',
        ];

        if (!empty($request->image)) {
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

        if (!empty($request->image)) {
            # code...
            // File::delete(public_path('userUploads/profilePicture/'.$user->image));
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;

            $image->move(public_path('userUploads/bookPicture'), $imageName);

            $book->image = $imageName;
            $book->save();

            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('userUploads/bookPicture/'.$imageName));
            $img->resize(990,990);
            $img->save(public_path('userUploads/bookPicture/'.$imageName));
        }

        return redirect()->route('books.index')->with('success', "Books added successfully!");
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
