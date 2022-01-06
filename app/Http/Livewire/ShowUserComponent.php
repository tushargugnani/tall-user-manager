<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowUserComponent extends Component
{
    protected $listeners = ['showModal' => 'showModal', 'refreshComponent' => '$refresh'];

    public $showModal = false;
    public $user;

    public function render()
    {
        return view('livewire.show-user-component',[
            'user' => $this->user,
            'roles' => isset($this->user) ? $this->user->roles : null,
            'permissions' => isset($this->user) ? $this->user->permissions  : null,
        ]);
    }

    public function showModal(User $user){
        $this->user = $user;
        $this->showModal = true;
    }

}
