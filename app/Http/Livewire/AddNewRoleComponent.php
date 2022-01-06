<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddNewRoleComponent extends Component
{
    protected $listeners = ['showModal'];

    public $showModal = false;
    public $roleName;

    protected $rules = [
        'roleName' => 'required|min:3',
    ];
 

    public function showModal(){
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.add-new-role-component');
    }

    public function addRole(){

        $this->validate();
        try{
            Role::create(['name' => $this->roleName]);
            $this->reset('roleName');
            $this->emit('refreshComponent');
            $this->showModal = false;
            $this->emit('successAlert', 'New Role Created');
        }catch(\Exception $e){
            $this->addError('roleName', $e->getMessage());
        }
    }

    public function closeModal(){
        $this->reset();
        $this->resetErrorBag();
    }
}
