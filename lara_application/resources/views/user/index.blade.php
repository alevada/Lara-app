@extends('layouts.app')

@section('title')
    Users | @parent
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
                <h2 class="text-uppercase">users</h2>
                @include('flash::message')
                <table class="table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>E-mail</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if($user->status=='A')
                                                        <span class="label label-primary">Active</span>
                                                    @else
                                                        <span class="label label-default">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <div class="btn-group btn-group-sm custom-icons">
                                                        <a href="{{ url('user/' . $user->id) }}"><span class="fa fa-pencil fa-1x"></span></a>
                                                        @if($user->role_id > 2)
                                                            <a href="{{ url('user/delete/' . $user->id) }}" class="actionDeleteUser"><span
                                                                    class="fa fa-close fa-1x"></span></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                        @else
                            No users defined
                        @endif
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary" href="{{url('user/create')}}">Add user</a>
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
    <script type="text/javascript" src="{{ url('/js/user.js') }}"></script>
@endsection