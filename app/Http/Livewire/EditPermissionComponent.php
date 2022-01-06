<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class EditPermissionComponent extends Component
{
    protected $listeners = ['showModal'];

    public $permission;
    public $showModal = false;

    public function showModal(Permission $permission){
        $this->permission = $permission;
        $this->showModal = true;
    }

    protected $rules = [
        'permission.name' => 'required|string|min:3',
    ];

    public function render()
    {
        return view('livewire.edit-permission-component');
    }

    public function closeModal(){
        $this->resetErrorBag();
    }

    public function save(){
        try{
            $this->validate();
            $this->permission->save();
            $this->showModal = false;
            $this->emit('refreshComponent');
            $this->emit('successAlert', 'Permission saved');
        }catch(\Exception $e){
            $this->addError('error', $e->getMessage());
        }
    }
}
