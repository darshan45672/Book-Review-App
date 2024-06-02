@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
           @include('layouts.sideBar')                
        </div>
        <div class="col-md-9">
            @include('layouts.sessionMessage')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Edit Reviews
                </div>
                <div class="card-body pb-0 mb-2">  
                    <form action="{{ route('account.review.update',$review->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea name="review" id="review" cols="30" rows="10" class="form-control @error('review') is-invalid @enderror ">{{ old('review',$review->review) }}</textarea>
                            @error('review')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label @error('status') is-invalid @enderror ">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ ($review->status == 1) ? 'selected':'' }}>Active</option>
                                <option value="0"{{ ($review->status == 0) ? 'selected':'' }}>Block</option>
                            </select>
                            @error('status')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-2">Update</button>
                    </form>               
                </div>
                
            </div>                
        </div>
    </div>       
</div>
@endsection