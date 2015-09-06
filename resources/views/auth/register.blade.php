@extends('authtemplate')

@section('title', 'Page Title')

@section('content')
<div class="row">
    <div class="col-xs-5 col-xs-offset-3 auth">
        <form method="POST" action="/auth/register">
            {!! csrf_field() !!}

            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}">
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
            </div>

            <div>
                <label for="confirm">Confirm Password</label>
                <input id="confirm" type="password" name="password_confirmation">
            </div>

            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection