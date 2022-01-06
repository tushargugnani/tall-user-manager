<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditUserComponent extends Component
{
    protected $listeners = ['showModal'];

    public $user;
    public $showModal = false;

    public function render()
    {
        return view('livewire.edit-user-component');
    }

    protected $rules = [
        'user.name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'string', 'email', 'max:255'],
    ];

    public function showModal(User $user){
        $this->user = $user;
        $this->showModal = true;
    }

    public function closeModal(){
        $this->reset();
        $this->resetErrorBag();
    }

    public function save(){
        try{
            $this->validate();
            $this->user->save();
            $this->showModal = false;
            $this->emit('refreshComponent');
            $this->emit('successAlert', 'User Saved');
        }catch(\Exception $e){
            $this->addError('error', $e->getMessage());
        }
    }
}
