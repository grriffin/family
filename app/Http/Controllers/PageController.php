<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Chat;
use Illuminate\Http\Request;
use Auth;
use Mail;

class PageController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $chats = Chat::orderBy('created_at', 'desc')->get();
        return view('welcome', [
            'chats' => $chats,
            'user'  => $user
        ]);
    }

    public function doMessage(Request $request) {
        $user = Auth::user();

        $input = $request->input('message');
        
        if (strpos($input, '@') !== FALSE) {
          $test = strstr($input, '@');

          $trim = explode(' ',trim($test));

          $name = substr($trim[0], 1); 

          $temp = User::where('name', $name)->first();

          $data = array( 'email' => $temp->email);

          Mail::send('emails.message', $data, function ($message) use ($data) {
            $message->from('popechats@campope.com');

            $message->to($data['email']);
          });
        }
        else {
           
        }

        if (isset($input) && $input !== '') {
            $chat = new Chat;
            $chat->user_id = $user->id;
            $chat->name    = $user->name;
            $chat->message = $input;
            $chat->save();

            $chats = Chat::all();
        }
        // print_r($user->email);
        return redirect()->action('PageController@index');
    }
}