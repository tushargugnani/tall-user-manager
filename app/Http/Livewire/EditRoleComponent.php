<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRoleComponent extends Component
{
    protected $listeners = ['showModal'];

    public $role;
    public $showModal = false;
    public $allPermissions;
    public $associatedPermissions;

    public function showModal(Role $role){
        $this->role = $role;
        $this->associatedPermissions = $this->role->permissions->pluck('name');
        $this->showModal = true;
        $this->emit('refreshPermissionSelect');
    }

    protected $rules = [
        'role.name' => 'required|string|min:3',
    ];

    public function mount(){
        $this->allPermissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.edit-role-component');
    }

    public function closeModal(){
        $this->reset('associatedPermissions');
        $this->resetErrorBag();
    }

    public function save(){
        try{
            $this->validate();
            $this->role->save();
            $this->role->syncPermissions($this->associatedPermissions);
            $this->showModal = false;
            $this->emit('refreshComponent');
            $this->emit('successAlert', 'Role Saved');
        }catch(\Exception $e){
            
        }
    }
}
