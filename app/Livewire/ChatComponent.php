<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class ChatComponent extends Component
{
    public $message;
    public $convo = [];

    public function mount(){
        $messages = Message::all();
        foreach($messages as $message){
            $this->convo[] = [
                "username" => $message->user->name,
                "message" => $message->message,
            ];
        }
    }

    #[On("echo:our-channel,MessageEvent")]
    public function listenForMessage($data)
    {

        $this->convo[] = [
            "username" => $data["username"],
            "message" => $data["message"],
        ];
    }

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function submitMessage()
    {
        MessageEvent::dispatch(Auth::id(),$this->message);
        $this->message = "";
    }
}
