@extends('layouts.app')

@section('topcss')
    <link href="{{ URL::to('/') }}/css/c3.css" rel="stylesheet" type="text/css"/>
@endsection

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
                <h2 class="text-uppercase">
                    {{Auth::user()->isPublisher() ? 'my ' : ''}}latest posts

                   
                    <form method="GET" action="{{ url('search') }}" accept-charset="UTF-8" role="form" class="form-horizontal search_post_form pull-right" enctype="multipart/form-data">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" placeholder="QUICK SEARCH POST" name="query" class="query form-control">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
            
                </h2>

                


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
                                    <td>{{ $post->author_full_name() == '' ? '-' : $post->author_full_name()}}</td>
                                    <td>{{ $post->category_name() }}</td>
                                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                    <td class="text-right">
                                        <div class="btn-group btn-group-sm custom-icons">
                                            <a href="{{ url('post/' . $post->id) }}"><span class="fa fa-pencil fa-1x"></span></a>
                                            <a href="{{ url('post/' . $post->id. '/delete') }}" class="actionDeletePost"><span class="fa fa-close fa-1x"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
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