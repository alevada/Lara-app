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
                <h2 class="text-uppercase">posts</h2>
                @include('flash::message')
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
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                                <tr>


		                            <td>{{ $post->title }}</td>
		                            <td>{{ $post->content }}</td>
                                    <td>{{ $post->author_full_name() == '' ? '-' : $post->author_full_name() }}</td>
                                    <td>{{ $post->category_name() }}</td>
                                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
		                                
                        
                                    <td class="text-right">
                                        <div class="btn-group btn-group-sm custom-icons">
                                            <a href="{{ url('post/' . $post->id . '?location=post') }}"><span class="fa fa-pencil fa-1x"></span></a>
                                            <a href="{{ url('post/' . $post->id. '/delete?location=post') }}" class="actionDeletePost"><span class="fa fa-close fa-1x"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            No posts added
                        @endif
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary" href="{{url('post/create')}}">Add post</a>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




@endsection

@section('endjs')
    <script type="text/javascript" src="{{ url('/js/post.js') }}"></script>
@endsection