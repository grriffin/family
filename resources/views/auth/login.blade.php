@extends('authtemplate')

@section('title', 'Page Title')

@section('content')
<div class="row">
    <div class="col-xs-5 col-xs-offset-3 auth">
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" id="password">
            </div>

            <div>
                <input id="remember" type="checkbox" name="remember"> <label for="remember">Remember Me</label>
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection