<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AddNewUserComponent extends Component
{
    protected $listeners = ['showModal'];

    public $showModal = false;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    public function showModal(){
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.add-new-user-component');
    }

    public function addUser(){
        
        $this->validate();
        try{
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            $this->reset();
            $this->emit('refreshComponent');
            $this->showModal = false;
            $this->emit('successAlert', 'New User Created');
        }catch(\Exception $e){
            $this->addError('error', $e->getMessage());
        }
    }

    public function closeModal(){
        $this->reset();
        $this->resetErrorBag();
    }
}
