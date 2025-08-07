<?php

namespace App\Services;

use App\Models\Respondent;

class RespondentsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } //endof constructor

    //function to create a new respondent 

    public function createRespondent($data)
    { 

        return Respondent::create($data); 

    } //endof funtion 
}
