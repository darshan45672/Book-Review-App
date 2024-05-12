<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, {{ Auth::user()->name }}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if (Auth::user()->image != "")
                        <img src="{{ asset('userUploads/profilePicture/'.Auth::user()->image) }}"
                            class="img-fluid rounded-circle" alt="{{ Auth::user()->name }}"
                            style="width: 150px; height: 150px;">
                        @endif
                        {{-- <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John"> --}}
                    </div>
                    <div class="h5 text-center">
                        <strong>{{ Auth::user()->name }}</strong>
                        <p class="h6 mt-2 text-muted">5 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header  text-white">
                    Navigation
                </div>
                <div class="card-body sidebar">
                    @include('layouts.sideBar')
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @include('layouts.sessionMessage')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Edit     Book
                </div>
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label @error('title') is-invalid @enderror ">Title</label>
                            <input type="text" value="{{ old('title', $book->title) }}" class="form-control" placeholder="Title" name="title" id="title" />
                            @error('title')
                            <p class="invalid-feedback"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label @error('author') is-invalid @enderror ">Author</label>
                            <input type="text" placeholder="Author" value="{{ old('author', $book->author) }}"class="form-control" name="author" id="author" />
                            @error('author')
                            <p class="invalid-feedback"> {{ $message }}</p>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="description" value="{{ old('description', $book->description) }}" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description"
                                cols="30" rows="5"></textarea>
                        </div>
    
                        <div class="mb-3">
                            <label for="Image" value="{{ old('image') }}" class="form-label @error('image') is-invalid @enderror ">Image</label>
                            <input type="file" class="form-control" name="image" id="image" />
                            @error('image')
                            <p class="invalid-feedback"> {{ $message }}</p>
                            @enderror
                            @if (!empty($book->image))
                                <img src="{{ asset('userUploads/bookPicture/'.$book->image) }}" class="w-25 my-2" alt="{{ $book->image }}">
                            @endif
                        </div>
    
                        <div class="mb-3">
                            <label for="status" value="{{ old('status') }}" class="form-label @error('status') is-invalid @enderror ">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ ($book->status == 1) ? 'selected' : '' }} >Active</option>
                                <option value="0" {{ ($book->status == 0) ? 'selected' : '' }} >Block</option>
                            </select>
                            @error('status')
                            <p class="invalid-feedback"> {{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection