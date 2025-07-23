<div>
<div class="flex h-screen">
    <!-- Users List -->
    <div class="w-1/4 border-r overflow-y-auto">
        @foreach ($users as $user)
            <div wire:click="selectUser({{ $user->id }})" class="p-4 cursor-pointer hover:bg-gray-100">
                {{ $user->name }} ({{ $user->role }})
            </div>
        @endforeach
    </div>

    <!-- Chat Section -->
    <div class="w-3/4 flex flex-col">
        @if ($selectedUser)
            <div class="border-b p-4 font-bold">
                Chat with {{ $selectedUser->name }}
            </div>

            <div class="flex-1 p-4 overflow-y-auto">
                @foreach ($messages as $msg)
                    <div class="mb-2 {{ $msg->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                        <div class="inline-block px-4 py-2 rounded 
                            {{ $msg->sender_id == auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-300' }}">
                            @if ($msg->message)
                                {!! nl2br(e($msg->message)) !!}
                            @endif
                            @if ($msg->file_path)
                                <br>
                                <a href="{{ asset('storage/' . $msg->file_path) }}" target="_blank" class="text-sm underline">
                                    📎 Download File
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 border-t flex items-center space-x-2">
                <form wire:submit.prevent="sendMessage" class="flex flex-1 space-x-2">
                    <input wire:model="newMessage" type="text" class="w-full border rounded p-2" placeholder="Type a message... 😊">
                    <input wire:model="file" type="file" class="hidden" id="fileInput">
                    <label for="fileInput" class="cursor-pointer px-2">📎</label>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Send</button>
                </form>
            </div>
        @else
            <div class="flex-1 flex justify-center items-center text-gray-500">Select a user to chat with.</div>
        @endif
    </div>
</div>

</div>
