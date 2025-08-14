<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserStatus extends Component
{
    public $user;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function toggleStatus(){
         $this->user->status = !$this->user->status;
        $this->user->save();
    }
    public function render()
    {
        return view('livewire.user-status');
    }
}

