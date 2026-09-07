<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Policies\MessagePolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class MsgController extends Controller
{
    use AuthorizesRequests;

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
        // Message::create([
        //     'message' => $validate['message'],
        //     'user_id' =>null,
        // ]);

        auth()->user()->messages()->create($validate);

        return redirect('/')->with("success","message created");
        
    }

    public function edit (Message $message){
        $this->authorize('update',$message);
        return view ('messages.edit',compact('message'));
    }

    public function update(Request $request , Message $message){
        $this->authorize('update',$message);

        $validate = $request ->validate(
            [
                'message' => 'required|string|max:255',
            ]
        );

            $message -> update($validate);

        
        return redirect ('/') -> with ("success","message updated");
        
    }

    public function destroy(Message $message){

    $this->authorize('delete',$message);
      

        $message -> delete();

        return redirect ('/') -> with ("success","message deleted");
        

    }
}
