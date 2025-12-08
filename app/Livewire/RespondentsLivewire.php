<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\RespondentsService;

class RespondentsLivewire extends Component
{ 
    public $respondents; 

    public function mount(RespondentsService $service)
    { 

      $this->respondents = $service->getAllRespondents();

    }
    public function render()
    {
        return view('livewire.respondents-livewire');
    }
}

