<div class="chat-component">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Users List -->
            <div class="col-md-3 border-end bg-light p-0">
                <div class="p-3 border-bottom bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Users</h5>
                </div>
                <div class="overflow-auto" style="max-height: 600px;">
                    @foreach ($users as $user)
                        <div wire:click="selectUser({{ $user->id }})" 
                             class="p-3 border-bottom cursor-pointer user-item {{ $selectedUser && $selectedUser->id == $user->id ? 'bg-primary text-white' : 'hover-bg-light' }}"
                             style="cursor: pointer;">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                </div>
                                <div>
                                    <strong>{{ $user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ ucfirst($user->role) }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Chat Section -->
            <div class="col-md-9 d-flex flex-column p-0">
                @if ($selectedUser)
                    <div class="border-bottom p-3 bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                                <i class="fas fa-comments text-primary"></i> 
                                Chat with {{ $selectedUser->name }}
                            </h5>
                            <small class="text-muted">{{ ucfirst($selectedUser->role) }}</small>
                        </div>
                        <button wire:click="refreshMessages" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>

                    <div class="flex-fill p-3 overflow-auto bg-light" style="max-height: 400px;">
                        @if(count($messages) == 0)
                            <div class="text-center text-muted mt-5">
                                <i class="fas fa-comment-slash fa-3x mb-3"></i>
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @else
                            @foreach ($messages as $msg)
                                <div class="mb-3 {{ $msg->sender_id == auth()->id() ? 'text-end' : 'text-start' }}">
                                    <div class="d-inline-block px-3 py-2 rounded {{ $msg->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-white border' }}" 
                                         style="max-width: 70%;">
                                        @if ($msg->message)
                                            {!! nl2br(e($msg->message)) !!}
                                        @endif
                                        @if ($msg->file_path)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $msg->file_path) }}" target="_blank" 
                                                   class="text-decoration-none {{ $msg->sender_id == auth()->id() ? 'text-light' : 'text-primary' }}">
                                                    <i class="fas fa-paperclip"></i> Download File
                                                </a>
                                            </div>
                                        @endif
                                        <div class="mt-1">
                                            <small class="{{ $msg->sender_id == auth()->id() ? 'text-light' : 'text-muted' }}">
                                                {{ $msg->created_at->format('H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="p-3 border-top bg-white">
                        <form wire:submit.prevent="sendMessage" class="d-flex gap-2">
                            <input wire:model="newMessage" type="text" 
                                   class="form-control" 
                                   placeholder="Type your message here... 💬"
                                   required>
                            <input wire:model="file" type="file" class="d-none" id="fileInput">
                            <button type="button" class="btn btn-outline-secondary" title="Attach file" onclick="document.getElementById('fileInput').click()">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Send
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex-fill d-flex justify-content-center align-items-center text-muted">
                        <div class="text-center">
                            <i class="fas fa-comments fa-4x mb-3"></i>
                            <h4>Welcome to Golden Bean Chat</h4>
                            <p>Select a user from the left to start chatting</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .user-item:hover {
            background-color: #f8f9fa !important;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        .hover-bg-light:hover {
            background-color: #f8f9fa;
        }
    </style>
</div>
