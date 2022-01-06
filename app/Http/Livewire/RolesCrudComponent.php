<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class RolesCrudComponent extends Component
{

    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $searchKeyword;

    public function render()
    {
        if(!empty($this->searchKeyword)){
            $roles = Search::add(Role::class, 'name')
            ->paginate(20)
            ->get($this->searchKeyword);
        }else{
            $roles = Role::paginate(20);
        }
        return view('livewire.roles-crud-component', [
            'roles' => $roles,
        ]);
    }
}
