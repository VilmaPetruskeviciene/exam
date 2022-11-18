@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Book</h2>
                </div>
                <div class="card-body">
                    <div class="truck-show">
                        <div class="line"><small>Title: </small><h5>{{$book->title}}</h5></div>
                        <div class="line"><small>Summary: </small><p>{{$book->summary}}</p></div>
                        <div class="line"><small>ISBN: </small><h5>{{$book->ISBN}}</h5></div>
                        <div class="line"><small>Pages: </small><h5>{{$book->pages}}</h5></div>
                        <div class="line"><small>Category: </small><h5>{{$book->getCategory->title}}</h5></div>
                        @forelse($book->getPhotos as $photo)
                            <div class="img">
                                <img class="show-img" src="{{$photo->url}}">
                            </div>
                        @empty
                            <h2>No photos yet.</h2>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
