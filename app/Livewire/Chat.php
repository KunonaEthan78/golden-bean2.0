<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    use WithFileUploads;

    public $users, $selectedUser, $messages = [];
    public $newMessage, $file;

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    public function selectUser($id)
    {
        $this->selectedUser = User::find($id);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->selectedUser->id)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'nullable|string',
            'file' => 'nullable|file|max:5120'
        ]);

        $path = $this->file ? $this->file->store('chat_uploads', 'public') : null;

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedUser->id,
            'message' => $this->newMessage,
            'file_path' => $path,
        ]);

        $this->newMessage = '';
        $this->file = null;

        broadcast(new MessageSent($message))->toOthers();

        $this->loadMessages();
    }

    #[On('echo:chat.{Auth::id()},MessageSent')]
    public function receiveMessage($payload)
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
