@extends('layouts.app')

@section('content')
<div class="container login_container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
                <div class="form-group static_item login_form_branding">
                    <strong>Welcome!</strong> Please log in.
                </div>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="username">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="password" type="password" class="form-control" name="password" placeholder="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary static_item">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
