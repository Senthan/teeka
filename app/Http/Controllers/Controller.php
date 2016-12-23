<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(auth()->check()) {
                $chatMessages = ChatMessage::with('user')->orderBy('created_at', 'DESC')->get()->take(100);
                $totalStaffs = User::count();
                $this->chatMessages = $chatMessages;
                $this->totalStaffs = $totalStaffs;
                view()->share('chatMessages', $this->chatMessages);
                view()->share('totalStaffs', $this->totalStaffs);
            }
            return $next($request);
        });
    }

}
