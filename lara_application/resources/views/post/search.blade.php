@extends('layouts.app')

@section('title')
    Posts | @parent
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>Hello, {{Auth::user()->first_name}}</h1>
            <br/>
        </div>
    </div>
</div>
<div class="grey">
    <div class="container listing_table">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-md-12">
                <h2 class="text-uppercase">search - <strong>{{$search_term}}</strong></h2>
                @include('flash::message')
                
                @if (count($posts))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>content</th>
                                <th>author</th>
                                <th>category</th>
                                <th>date</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>{{ $post->author_full_name() == '' ? '-' : $post->author_full_name() }}</td>
                                    <td>{{ $post->category_name() }}</td>
                                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        
                                    <td class="text-right">
                                        <div class="btn-group btn-group-sm custom-icons">
                                            <a href="{{ url('post/' . $post->id) }}"><span class="fa fa-pencil fa-1x"></span></a>
                                            <!-- @if($post->role_id > 2) -->
                                                <a href="{{ url('post/delete/' . $post->id) }}" class="actionDeletePost"><span
                                                        class="fa fa-close fa-1x"></span></a>
                                            <!-- @endif -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="table">No posts found matching <strong>{{$search_term}}</strong>! <a href="{{ url('/home') }}">Go back</a></div>
                @endif
            </div>
        </div>
    </div>
</div>




@endsection

@section('endjs')
    <script type="text/javascript" src="{{ url('/js/post.js') }}"></script>
@endsection

























