@extends('master')

@section('title', 'Page Title')

@section('content')
  <div id="home">
  <script>
  
	var lastChatId = <?php echo $lastChatId ;?>;
	var lastMissedId = 0;

	function CheckForMessages(id) {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'getmissingmessagecount?lastId=' + id);
		xhr.onload = function() {
			if ( xhr.status = 200 ) {
				console.log(xhr.responseText);
				var response = JSON.parse(xhr.responseText);
				if ( response.missedMessagesCount > 0 && lastMissedId != response.lastId ) {
					/*even though we haven't refreshed yet, we only need
					to update the button when there are more messages. So
					might as well update the last id now.*/
					lastMissedId = response.lastId;
					var mc = document.getElementById("messageCount");
					while (mc.firstChild) {
						mc.removeChild(mc.firstChild);
					}
					var input = document.createElement("INPUT");
					input.className = "btn btn-success";
					input.value = "Load " + response.missedMessagesCount + " more message" + (response.missedMessagesCount > 1 ? "s" : "");
					input.onclick = function () { window.location.reload(); };
					mc.appendChild(input);
					
					}
				}
			else {
				console.log('Message request failed ' + xhr.status);
			}
		};
		xhr.send();
	}
	(function() {

		var timer = setInterval(function() { CheckForMessages(lastChatId) }, 3000);
		
	}());
  </script>
    <div class="row navigation">
      <div>

      </div>
      <div>
        @if (Auth::check())
        <a class="btn btn-primary" href="auth/logout">Logout</a>
        @else
        <a class="btn btn-primary" href="auth/login">Login</a>
        <a class="btn btn-primary" href="auth/register">Sign Up</a>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-8">
        @if (Auth::check())
          <h2>Welcome {{$user->name}}</h2>

		  <div id="messageCount" class="refreshbuttoncontainer" >
		  </div>
          @if (isset($chats))
            @foreach ($chats as $chat)
              <div class="printchat">
                <p>{{ $chat->name }}</p>
                <p>{{$chat->created_at}}</p>
                <p>{{ $chat->message }}</p>
              </div>
            @endforeach
          @endif
      </div>
      <div class="col-md-4">
        <p class="message-text">Please post your message here.</p>
        <form id="chatform" method="POST" action="lol">
          {!! csrf_field() !!}
          <textarea required name="message" form="chatform"></textarea>
          <input type="submit" name="submit" class="btn btn-success">
        </form>
        @else 
          <p>You are not signed in.</p>
          <h2>Admin Notes From Cam</h2>
          <p>Gonna be doing a ton of changes to this pretty quick so don't be alarmed if the interface changes a lot each time you come :)</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection