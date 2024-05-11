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
                        <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John">
                    </div>
                    <div class="h5 text-center">
                        <strong>{{ $user->email }}</strong>
                        <p class="h6 mt-2 text-muted">5 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header  text-white">
                    Navigation
                </div>
                <div class="card-body sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="book-listing.html">Books</a>
                        </li>
                        <li class="nav-item">
                            <a href="reviews.html">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.html">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="my-reviews.html">My Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a href="change-password.html">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('account.logOut') }}">Logout</a>
                        </li>
                    </ul>
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
                    <form action="{{ route('account.userProfileUpdate') }}" method="POST">
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
                            <input type="file" name="image" id="image" class="form-control">
                            <img src="images/profile-img-1.jpg" class="img-fluid mt-4" alt="Luna John">
                        </div>
                        <button class="btn btn-primary mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection