@extends('master')

@section('title', 'Page Title')

@section('content')
  <div id="home">
    <div class="row navigation">
      <div class="col-sm-8">

      </div>
      <div class="col-sm-4">
        @if (Auth::check())
        <a class="btn btn-primary" href="auth/logout">Logout</a>
        @else
        <a class="btn btn-primary" href="auth/login">Login</a>
        <a class="btn btn-primary" href="auth/register">Sign Up</a>
        @endif
      </div>
    </div>
    <div class="row">
      @if (Auth::check())
        <h2>Sup {{$user->name}}</h2>
        @if (isset($chats))
          @foreach ($chats as $chat)
            <div class="printchat">
              <p>{{ $chat->name }}</p><p>{{ $chat->message }}</p>
            </div>
          @endforeach
        @endif
        <form id="chatform" method="POST" action="">
          {!! csrf_field() !!}
          <textarea name="message" form="chatform"></textarea>
          <input type="submit" name="submit" class="btn btn-success">
        </form>
      @else 
        <p>You are not signed in.</p>
      @endif
     
    </div>
  </div>
@endsection