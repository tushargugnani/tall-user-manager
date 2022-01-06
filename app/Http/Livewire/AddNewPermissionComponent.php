<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AddNewPermissionComponent extends Component
{

    protected $listeners = ['showModal'];

    public $showModal = false;
    public $permissionName;

    protected $rules = [
        'permissionName' => 'required|min:3',
    ];
 

    public function showModal(){
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.add-new-permission-component');
    }

    public function addPermission(){

        $this->validate();
        try{
            Permission::create(['name' => $this->permissionName]);
            $this->reset('permissionName');
            $this->emit('refreshComponent');
            $this->showModal = false;
            $this->emit('successAlert', 'New Permission Created');
        }catch(\Exception $e){
            $this->addError('permissionName', $e->getMessage());
        }
    }

    public function closeModal(){
        $this->reset();
        $this->resetErrorBag();
    }
}
