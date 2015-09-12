<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Chat;
use Illuminate\Http\Request;
use Auth;

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
        $chats = Chat::all();
        return view('welcome', [
            'chats' => $chats,
            'user'  => $user
        ]);
    }

    public function doMessage(Request $request) {
        $user = Auth::user();

        $input = $request->input('message');
        
        if (isset($input) && $input !== '') {
            $chat = new Chat;
            $chat->user_id = $user->id;
            $chat->name    = $user->name;
            $chat->message = $input;
            $chat->save();

            $chats = Chat::all();
        }

        return redirect()->action('PageController@index');
    }
}