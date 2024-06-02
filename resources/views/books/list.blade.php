<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

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
                    Books
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
                        <form action="" method="GET">
                            <div class="d-flex gap-3">
                                <input type="text" value="{{ Request::get('keyword') }}" class="form-control" name="keyword" placeholder="Keyword">
                                <button type="submit" class="btn btn-primary"> Search</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">Clear</a>
                            </div>
                        </form>
                    </div>
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                        <tbody>
                            @if ($books->isNotEmpty())
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>3.0 (3 Reviews)</td>
                                <td>@if ($book->status == 1)
                                    <span class="text-success">Active</span>
                                    @else
                                    <span class="text-danger">Blocked</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" >
                                        @csrf
                                        {{-- <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a> --}}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>                                    
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td colspan="5" class="text-center"> No Books Available </td>
                            @endif

                        </tbody>
                        </thead>
                    </table>
                    @if ($books->isNotEmpty())
                    {{ $books->links() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection