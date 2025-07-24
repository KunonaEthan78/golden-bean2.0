<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    use WithFileUploads;

    public $users, $selectedUser, $messages = [];
    public $newMessage, $file;

    // Remove the problematic listener for now - we'll implement a simpler version
    // protected $listeners = ['echo:chat.{Auth::id()},MessageSent' => 'receiveMessage'];

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

        // Remove broadcasting for now to simplify
        // broadcast(new MessageSent($message))->toOthers();

        $this->loadMessages();
    }

    // Simple refresh method instead of real-time updates
    public function refreshMessages()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat-fixed')
            ->layout('livewire.chat-layout');
    }
}
