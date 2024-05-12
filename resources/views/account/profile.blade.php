<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, {{ $user->name }}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if (Auth::user()->image != "")
                            <img src="{{ asset('userUploads/profilePicture/'.Auth::user()->image) }}" class="img-fluid rounded-circle" alt="{{ Auth::user()->name }}" style="width: 150px; height: 150px;"> 
                        @endif
                        {{-- <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John"> --}}
                    </div>
                    <div class="h5 text-center">
                        <strong>{{ $user->name }}</strong>
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
                    Profile
                </div>
                <div class="card-body">
                    <form action="{{ route('account.userProfileUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ old('name', $user->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name"
                                id="" />
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" value="{{old('email', $user->email)}}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                name="email" id="email" />
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            {{-- <img src="images/profile-img-1.jpg" class="img-fluid mt-4" alt="Luna John"> --}}
                        </div>
                        <button class="btn btn-primary mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection