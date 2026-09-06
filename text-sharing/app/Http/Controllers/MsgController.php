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

    public function edit (Message $message){
        return view ('messages.edit',compact('message'));
    }

    public function update(Request $request , Message $message){
        $validate = $request ->validate(
            [
                'message' => 'required|string|max:255',
            ]
        );

            $message -> update($validate);

        
        return redirect ('/') -> with ("success","message updated");
        
    }

    public function destroy(Message $message){
      

        $message -> delete();

        return redirect ('/') -> with ("success","message deleted");
        

    }
}
