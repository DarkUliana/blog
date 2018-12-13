@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @foreach($posts as $post)
                    @if($loop->first || $loop->iteration%2 == 1)
                        <div class="card-group">
                            @endif
                            <div class="card m-2">
                                <a href="{{ url($post->id) }}">
                                    <img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->short }}</p>
                                    </div>
                                </a>
                            </div>
                            @if($loop->last || $loop->iteration%2 == 0)
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
