@extends('layouts.default')
@section('custom-css')
<link href="/css/login.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-flex justify-content-center h-100">
    <div class="card">
        <div class="card-header">
            <h3>Sign In</h3>
            <div class="d-flex justify-content-end social_icon">
                <span><i class="fab fa-facebook-square"></i></span>
                <span><i class="fab fa-google-plus-square"></i></span>
                <span><i class="fab fa-twitter-square"></i></span>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('postlogin')}}" method="POST" id="loginForm">
                {{ csrf_field() }}
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                <input type="text" name="username" class="form-control" placeholder="username" value="{{ old('username') }}">
                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                @if($errors->any())
                    <div class="invalid-feedback d-block">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                <div class="row align-items-center remember">
                    <input type="checkbox">Remember Me
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" class="btn float-right login_btn">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
@endsection
