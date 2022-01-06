<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageUserRolesComponent extends Component
{
    protected $listeners = ['showModal'];

    public $user;
    public $showModal = false;
    public $allRoles;
    public $associatedRoles;

    public $allPermissions;
    public $associatedPermissions;

    public function showModal(User $user){
        $this->user = $user;
        $this->associatedRoles = $this->user->roles->pluck('name');
        $this->associatedPermissions = $this->user->permissions->pluck('name');
        $this->showModal = true;
        $this->emit('refreshRoleSelect');
    }

    public function mount(){
        $this->allRoles = Role::all();
        $this->allPermissions = Permission::all();
    }


    public function render()
    {
        return view('livewire.manage-user-roles-component');
    }

    public function closeModal(){
        $this->reset('associatedRoles');
        $this->reset('associatedPermissions');
        $this->resetErrorBag();
    }

    public function saveRoles(){
        try{
            $this->user->syncRoles($this->associatedRoles);
            $this->user->syncPermissions($this->associatedPermissions);
            $this->showModal = false;
            $this->emit('refreshComponent');
            $this->emit('successAlert', 'Roles and Permissions Saved');
        }catch(\Exception $e){
            $this->addError('error', $e->getMessage());
        }
    }
}
