@extends('layouts.guest')

@section('content')
<div id="login" class="row align-items-center justify-content-center">
    <div class="col col-4">
        <form action="{{route('login')}}" method="post">
            @csrf
            <h1>Login</h1>
            <p><small>Sign In to your account</small></p>
            @if($errors->first('credetial'))
            <div class="form-group">
                <div class="alert alert-danger alert-dismissible fade show">
                    @foreach($errors->all() as $k)
                    {{$errors->first('credetial')}}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control {{$errors->first('email')?'is-invalid':''}}" name="email" id="email" placeholder="Email" autocomplete="off">
                    <span class="invalid-feedback {{$errors->first('email')?'':'sr-only'}}">{{$errors->first('email')}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="password" class="form-control {{$errors->first('password')?'is-invalid':''}}" name="password" id="password" placeholder="Password" autocomplete="off">
                    <span class="invalid-feedback {{$errors->first('password')?'':'sr-only'}}">{{$errors->first('password')}}</span>
                </div>
            </div>
            <div class="w-100 mt-3">
                <button type="submit" class="btn btn-primary">@ Login</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('style')
<style>
    #login {
        height: 100vh;
    }
</style>
@endsection