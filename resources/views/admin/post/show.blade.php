@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Post {{ $post->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/post') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        @can('update-own-post', $post)
                        <a href="{{ url('/admin/post/' . $post->id . '/edit') }}" title="Edit Post">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>
                        @endcan

                        @can('delete-own-post', $post)
                        <form method="POST" action="{{ url('admin/post' . '/' . $post->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Post"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                        @endcan
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $post->id }}</td>
                                </tr>
                                <tr>
                                    <th> Image</th>
                                    <td> {{ $post->image }} </td>
                                </tr>
                                <tr>
                                    <th> Title</th>
                                    <td> {{ $post->title }} </td>
                                </tr>
                                <tr>
                                    <th> Short</th>
                                    <td> {{ $post->short }} </td>
                                </tr>
                                <tr>
                                    <th> Text</th>
                                    <td> {{ $post->text }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
