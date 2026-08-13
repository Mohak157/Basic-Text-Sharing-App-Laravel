<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MsgController extends Controller
{
    public function index(){
        $messages = Message::with('user')->latest()->take(50)->get();


        return view('home',['messages' => $messages]);
    }

    public function store(Request $request) {
        $validate = $request -> validate(
            [
                'message' => 'required|string|max:255',
            ]
        );
        Message::create([
            'message' => $validate['message'],
            'user_id' => null,
        ]);

        return redirect('/')->with("success","message created");
        
    }
}
