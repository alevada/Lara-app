@extends('layouts.app')

@section('title')
    Posts | @parent
@stop

@section('topcss')
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-12"><h3>{{$post->author_id == Auth::user()->id ? 'Edit my post' : 'Edit post'}}</h3></div>
            </div>
            <div class="col-md-12">
                @include('flash::message')

                {!! Form::open(array('url' => 'post/' . $post->id, 'role' => 'form', 'class' => 'form-horizontal', 'method' => 'put', 'files' => true)) !!}
                <div class="row">
                    <div class="col-md-12">
                        @include('post.partials.form')
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-sm-12">
                        <div class="text-right">
                            {!! Form::submit("Save", ['class'=>'btn btn-primary']) !!}
                            <a class="btn btn-default" href="{{ url('/post') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                <br><br>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('endjs')
@endsection