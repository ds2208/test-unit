@extends('auth._layout.layout')

@section('content')
<p class="login-box-msg">{{__("Izmeni svoju lozinku.")}}</p>

<form action="{{route('admin.profile.change_password_confirm')}}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input 
            type="password" 
            class="form-control @if($errors->has('old_password')) is-invalid @endif" 
            placeholder="Old Password"
            name="old_password"
            >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock-open"></span>
            </div>
        </div>
        @include('admin._layout.partials.form_errors', ['fieldName' => 'old_password'])
    </div>
    <div class="input-group mb-3">
        <input 
            type="password" 
            class="form-control @if($errors->has('new_password')) is-invalid @endif" 
            name="new_password"
            placeholder="New Password"
            >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @include('admin._layout.partials.form_errors', ['fieldName' => 'new_password'])
    </div>
    <div class="input-group mb-3">
        <input 
            type="password" 
            class="form-control @if($errors->has('new_password_confirm')) is-invalid @endif" 
            placeholder="Confirm New Password"
            name="new_password_confirm"
            >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @include('admin._layout.partials.form_errors', ['fieldName'=> 'new_password_confirm'])
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">{{__("Potvrdi menjanje lozinke")}}</button>
        </div>
        <div class="col-12">
            <a href="{{route('admin.profile.edit')}}" class="btn btn-danger">{{__("Prekini")}}</a>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="{{ route('password.request') }}">{{__("Zaboravio sam lozinku")}}</a>
</p>
@endsection