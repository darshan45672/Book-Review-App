<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index( Request $request){
        $reviews = Review::with('book','user')->orderBy('created_at','desc');

        if (!empty($request->keyword)) {
            # code...
            $reviews = $reviews->where('review','like','%'.$request->keyword.'%');
            // dd($reviews);
        }
        $reviews = $reviews->paginate(10);

        return view('account.reviews.list',[
            'reviews' => $reviews,
        ]);
    }

    public function edit($id){
        $review = Review::findOrFail($id);
        // dd($review);

        return view('account.reviews.edit',[
            'review' => $review,
        ]);
    }

    public function update(Request $request ,$id){
        $review = Review::findOrFail($id);
        
        $validator = Validator::make($request->all(),[
            'review' => 'required| min:5',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.review.edit',$id)->withInput()->withErrors($validator);
        }

        $review->review = $request->review;
        $review->status = $request->status;
        $review->save();

        return redirect()->route('account.reviews')->with('success', "Review Updated Sucessfully");
    }
}
