@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Category</h2>
                </div>
                <div class="card-body">
                    <div class="category">
                        <h5>{{$category->title}}</h5>
                    </div>
                    <ul class="list-group">
                        @forelse($category->books as $book)
                        <li class="list-group-item">
                            <div class="movies-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{$book->title}} </h2>
                                    <h4><span>ISBN: </span>{{$book->ISBN}}</h4>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No books found</li>
                        @endforelse
                    </ul>
                    <div class="buttons mt-2">
                        <form action="{{route('c_delete_books', $category)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete all books</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
