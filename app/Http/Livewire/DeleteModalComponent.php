<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class DeleteModalComponent extends Component
{

    public $modalHeading = '';
    public $modalMessage = '';
    public $showModal = false;
    public $model;

    protected $listeners = ['showModal'];

    public function showModal($modelType, $modelId, $modalHeading, $modalMessage){
        $this->showModal = true;
        $this->model = $modelType::findOrFail($modelId);
        $this->modalHeading = $modalHeading;
        $this->modalMessage = $modalMessage;
    }

    public function destroy(){
        try{
            $this->model->delete();
                        //Only for live website (to create another record against deleted)
                        //$this->model->factory()->create();
            $this->emit('refreshComponent');
            $this->emit('successAlert', 'Deleted successfully');
            $this->showModal = false;

        }catch(\Exception $e){
            $this->emit('successError', 'Problem deleting, Try again later.');
        }
    }

    public function render()
    {
        return view('livewire.delete-modal-component');
    }
}
