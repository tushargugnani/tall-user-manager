<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class UsersCrudComponent extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $searchKeyword;

    public function render()
    {
        if(!empty($this->searchKeyword)){
            $users = Search::add(User::with('roles'), ['name', 'email'])
            ->paginate(20)
            ->get($this->searchKeyword);
        }else{
            $users = User::with('roles')->paginate(20);
        }
        return view('livewire.users-crud-component', [
            'users' => $users
        ]);
    }

}
