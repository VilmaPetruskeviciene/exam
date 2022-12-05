@extends('layouts.app')

@section('content')
<div class="container --content col-8">
    <div class="row justify-content-center">
        <div class="mb-2">
            <div class="card">
                <div class="card-header">
                    <h2>Books</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <form action="{{route('home')}}" method="get">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-5">
                                                <select name="cat" class="form-select mt-1">
                                                    <option value="0">All</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($cat==$category->id) selected @endif>{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <select name="sort" class="form-select mt-1">
                                                    <option value="0">All</option>
                                                    @foreach($sortSelect as $option)
                                                    <option value="{{$option[0]}}" @if($sort==$option[0]) selected @endif>{{$option[1]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <button type="submit" class="input-group-text mt-1">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-7">
                                <form action="{{route('home')}}" method="get">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="s" class="form-control" value="{{$s}}">
                                                    <button type="submit" class="input-group-text">Search</button>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{route('home')}}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @forelse($books as $book)
            <li class="list-group-item">
                <div class="movies-list books-group">
                    <div class="content mb-3">
                        @if($book->getPhotos()->count())
                        <img class="index-img" src="{{$book->getPhotos()->first()->url}}">
                        @endif
                        <h2><span>Title: </span>{{$book->title}}</h2>
                        <h4 class="mx-3"><span>Rating: </span>{{$book->rating ?? 'no rating'}}</h4>
                        <div class="buttons">
                            <form action="{{route('rate', $book)}}" method="post">
                                <select name="rate">
                                    @foreach(range(1, 10) as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-info">Rate</button>
                            </form>
                        </div>
                    </div>
                    <div class="content mb-3">
                        <h4><span>ISBN: </span>{{$book->ISBN}}</h4>
                        <h4><span>Pages: </span>{{$book->pages}}</h4>
                        <h5>
                            <span>Category: </span>
                            <a href="{{route('c_show', $book->getCategory->id)}}">
                                {{$book->getCategory->title}}
                            </a>
                        </h5>
                    </div>
                    <div class="content mb-3">
                        <h6><span>Summary: </span>{{$book->summary}}</h6>
                    </div>
                </div>
            </li>
            @empty
            <li class="list-group-item">No book found</li>
            @endforelse
        </ul>
    </div>
    <div class="me-3 mx-3">
        {{ $books->links() }}
    </div>
</div>
@endsection
