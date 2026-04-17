<?php

namespace App\Livewire;

use Livewire\Component;

class PrefcityComponent extends Component
{
    public $pref;
    public $selectedPref;
    public $cities=[];

    public function mount(){
        $json=file_get_contents(public_path('json/pref_city.json'));
        $data=json_decode($json,true);
        $this->pref=$data;
    }

    public function updatedSelectedPref($value){
        $this->cities=$this->pref[$value]['cities'];
    }


    public function render()
    {
        return view('livewire.prefcity-component');
    }
}