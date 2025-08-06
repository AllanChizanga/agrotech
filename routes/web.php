<?php

use App\Livewire\LoginLivewire;
use App\Http\Middleware\IsAdmin;
use App\Livewire\ReportsLivewire;
use App\Livewire\QuestionLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\RespondentsLivewire;
use Illuminate\Support\Facades\Route;
use App\Livewire\QuestionnaireLivewire;
use App\Http\Controllers\UserController;
use App\Livewire\DataCollectorsLivewire;


//authentication routes 

Route::controller(UserController::class)->group(function () {

    Route::get('/login', 'login');
    Route::post('login','authenticate')->name('login');
   
});


//dashboard route

Route::get('/', DashboardLivewire::class)->name('dashboard')->middleware(IsAdmin::class); 

//data collectors management  


Route::get('data-collectors',DataCollectorsLivewire::class)->name('data-collectors')->middleware(IsAdmin::class);



//questionnaires 


Route::get('questionnaires', QuestionnaireLivewire::class)
    ->name('questionnaires')
    ->middleware(IsAdmin::class);

//respondents 


Route::get('respondents', RespondentsLivewire::class)
        ->name('respondents')
        ->middleware(IsAdmin::class); 


//reports 

Route::get('reports', ReportsLivewire::class)
    ->name('reports')
    ->middleware(IsAdmin::class); 

//question livewire 

Route::get('questions/{id}', QuestionLivewire::class)
    ->name('questions')
    ->middleware(IsAdmin::class); 

