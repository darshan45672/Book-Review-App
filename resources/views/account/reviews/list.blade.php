@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
           @include('layouts.sideBar')                
        </div>
        <div class="col-md-9">
            
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    My Reviews
                </div>
                <div class="card-body pb-0">  
                    <div class="d-flex justify-content-end">
                        <form action="" method="GET">
                            <div class="d-flex gap-3">
                                <input type="text" value="{{ Request::get('keyword') }}" class="form-control" name="keyword" placeholder="Keyword">
                                <button type="submit" class="btn btn-primary"> Search</button>
                                <a href="{{ route('account.reviews') }}" class="btn btn-secondary">Clear</a>
                            </div>
                        </form>
                    </div>          
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>User</th>
                                <th>Book</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Created At</th>                                  
                                <th>Status</th>                                  
                                <th width="100">Action</th>
                            </tr>
                            <tbody>
                                @if ($reviews->isNotEmpty())
                                    @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->user->name }}</td>                                        
                                        <td>{{ $review->book->title }}</td>
                                        <td>{{ $review->review }}</td>                                        
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            @if ($review->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="edit-review.html" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                                              
                            </tbody>
                        </thead>
                    </table>   
                    {{ $reviews->links()}}                
                </div>
                
            </div>                
        </div>
    </div>       
</div>
@endsection