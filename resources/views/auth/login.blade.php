
@extends('admin.layouts.master_admin')

@section('content')
<div id="authDashbord">
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="email">
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="password">
        </div>
        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</div>
@endsection