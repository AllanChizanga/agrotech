<?php

namespace App\Services;

use App\Models\Option;

class OptionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    public function saveOptions($question_id,$options)
    {
      foreach ($options as $optionText) {
        if (trim($optionText) !== '') {
            
            static $optionOrder = 1;
            Option::create([
                'question_id' => $question_id,
                'option_text' => $optionText,
                'option_order' => $optionOrder++,
            ]);
        }
       }

    }//endof function 
}
