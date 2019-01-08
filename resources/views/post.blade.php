@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->text }}</p>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Залишити коментар</div>
                    <div class="card-body">
                        @include('create-comment')
                    </div>
                </div>

                <div class="card" id="comments">
                    <div class="card-header">Коментарі</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($comments as $comment)
                                @include('comment', ['comment' => $comment])
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
