<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ChatMessage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function groupChat(Request $request) {
        if(Auth::check() && $request->type == 'group') {
            $message = \App\ChatMessage::create([
                'user_id' => auth()->id(),
                'message' => $request->msg
            ]);

        }
    }
    public function index(User $user)
    {
        $staffs = isset($user['id']) ?  User::whereIn('id', [$user['id'], Auth::id()])->get() : User::all();
        $chatMessages = ChatMessage::with('user')->get();
        return view('chat.index',  compact('staffs', 'chatMessages'));
    }
}
