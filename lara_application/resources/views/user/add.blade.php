@extends('layouts.app')

@section('title')
    Users | @parent
@stop

@section('topcss')
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-12"><h3>Add user</h3></div>
            </div>
            <div class="col-md-12">
                @include('flash::message')

                {!! Form::open(array('url' => 'user', 'role' => 'form', 'class' => 'form-horizontal', 'method' => 'post', 'files' => true)) !!}
                <div class="row">
                    <div class="col-md-12">
                        @include('user.partials.form')
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-sm-12">
                        <div class="text-right">
                            {!! Form::submit("Save", ['class'=>'btn btn-primary']) !!}
                            <a class="btn btn-default" href="{{ url('/user') }}">Cancel</a>
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