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
   

        //check if the given respondent exists in the db
        $respondent = Respondent::where('national_id', $data['national_id'])->first();
        if ($respondent) {
            return $respondent;
        }

        return Respondent::create($data); 

    } //endof funtion 

    //function to load all respondents 

public function getAllRespondents()
{
    return Respondent::all();
}//endof func
 

}//endof class
