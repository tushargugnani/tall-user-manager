<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class PermissionsCrudComponent extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $searchKeyword;

    public function render()
    {
        if(!empty($this->searchKeyword)){
            $permissions = Search::add(Permission::class, 'name')
            ->paginate(20)
            ->get($this->searchKeyword);
        }else{
            $permissions = Permission::paginate(20);
        }
        return view('livewire.permissions-crud-component', [
            'permissions' => $permissions,
        ]);
    }
}
