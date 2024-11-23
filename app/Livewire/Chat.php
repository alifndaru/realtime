<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Chat extends Component
{

    public User $user;
    public $message = '';


    public function render()
    {
        return view('livewire.chat', [
            'messages' => Message::where(function (Builder $query) {
                $query->where('from', auth()->id())
                    ->where('to', $this->user->id);
            })->orWhere(function (Builder $query) {
                $query->where('from', $this->user->id)
                    ->where('to', auth()->id());
            })
                ->orderBy('created_at', 'asc')  // Urutkan berdasarkan waktu (lama ke baru)
                ->get()
        ]);
    }


    public function sendMessage(){
        Message::create([
            'from' => auth()->id(),
            'to' => $this->user->id,
            'message' => $this->message
        ]);

        $this->reset('message');
        $this->dispatch('message-sent');    }
}
