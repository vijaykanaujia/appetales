@extends('layouts.authenticated')
@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('msg')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col col-4">
        <div class="card text-center">
            <div class="card-body">
                @if($user->avatar)
                <img class="img-fluid rounded mx-auto d-block" src="{{asset('storage/' . $user->avatar)}}" alt="{{$user->name}}">
                @else
                <img class="img-fluid rounded mx-auto d-block" src="https://fakeimg.pl/300/" alt="Avatr">
                @endif
            </div>
            <P>{{$user->name}}</P>
            <p><a type="button" href="{{route('logout')}}" class="btn btn-sm btn-info">Logout</a></p>
        </div>
    </div>
    <div class="col">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link {{(session('tab') == 'info') ? 'active': ''}}" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info" aria-selected="true">Personal Info</button>
                <button class="nav-link {{(session('tab') == 'avatar') ? 'active': ''}}" id="change-avatar-tab" data-bs-toggle="tab" data-bs-target="#change-avatar" type="button" role="tab" aria-controls="change-avatar" aria-selected="false">Change Avatar</button>
                <button class="nav-link {{(session('tab') == 'password') ? 'active': ''}}" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">Change Password</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade {{(session('tab') == 'info') ? 'show active': ''}}" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab" tabindex="0">
                <form action="{{route('user.update')}}" method="post" class="p-2">
                    @csrf
                    <input type="hidden" name="updateBasicInfo" value="updateBasicInfo">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">@</span>
                            <input id="name" type="text" class="form-control {{$errors->first('name')?'is-invalid':''}}" name="name" value="{{$user->name}}" id="name" placeholder="name" autocomplete="off">
                            <span class="invalid-feedback {{$errors->first('name')?'':'sr-only'}}">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="email">@</span>
                            <input id="email" type="email" class="form-control {{$errors->first('email')?'is-invalid':''}}" name="email" value="{{$user->email}}" id="email" placeholder="email" autocomplete="off">
                            <span class="invalid-feedback {{$errors->first('email')?'':'sr-only'}}">{{$errors->first('email')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="form-label">Mobile</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="mobile">@</span>
                            <input id="mobile" type="text" class="form-control {{$errors->first('mobile')?'is-invalid':''}}" name="mobile" value="{{$user->mobile}}" id="mobile" placeholder="mobile" autocomplete="off">
                            <span class="invalid-feedback {{$errors->first('mobile')?'':'sr-only'}}">{{$errors->first('mobile')}}</span>
                        </div>
                    </div>

                    <div class="w-100">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>

                </form>
            </div>
            <div class="tab-pane fade {{(session('tab') == 'avatar') ? 'show active': ''}}" id="change-avatar" role="tabpanel" aria-labelledby="change-avatar-tab" tabindex="0">
                <form action="{{route('user.update')}}" method="post" class="p-2" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="updateAvatar" value="updateAvatar">
                    <div class="form-group mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input class="form-control {{$errors->first('avatar')?'is-invalid':''}}" type="file" name="avatar">
                        <span class="invalid-feedback {{$errors->first('avatar')?'':'sr-only'}}">{{$errors->first('avatar')}}</span>
                    </div>
                    <div class="w-100">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade {{(session('tab') == 'password') ? 'show active': ''}}" id="change-password" role="tabpanel" aria-labelledby="change-password-tab" tabindex="0">
                <form action="{{route('user.update')}}" method="post" class="p-2">
                    @csrf
                    <input type="hidden" name="updatePassword" value="updatePassword">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">@</span>
                            <input id="current_password" type="password" class="form-control {{$errors->first('current_password')?'is-invalid':''}}" name="current_password" value="{{$user->current_password}}" id="current_password" placeholder="current_password" autocomplete="off">
                            <span class="invalid-feedback {{$errors->first('current_password')?'':'sr-only'}}">{{$errors->first('current_password')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">@</span>
                            <input id="new_password" type="password" class="form-control {{$errors->first('new_password')?'is-invalid':''}}" name="new_password" value="{{$user->new_password}}" id="new_password" placeholder="new_password" autocomplete="off">
                            <span class="invalid-feedback {{$errors->first('new_password')?'':'sr-only'}}">{{$errors->first('new_password')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="retype_password" class="form-label">Retype Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">@</span>
                            <input id="retype_password" type="password" class="form-control {{$errors->first('retype_password')?'is-invalid':''}}" name="retype_password" value="{{$user->retype_password}}" id="retype_password" placeholder="retype_password" autocomplete="off">
                            <span class="invalid-feedback {{$errors->first('retype_password')?'':'sr-only'}}">{{$errors->first('retype_password')}}</span>
                        </div>
                    </div>
                    <div class="w-100">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    img {
        width: 200px;
        height: 200px;
    }
</style>
@endsection

@section('script')
<script>
    function numberOnly(val) {
        val.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    }
</script>
@endsection