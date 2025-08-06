<?php

namespace App\Services;

use Log;
use Exception;
use App\Models\Form;

class QuestionnaireService
{
     private $authUser; 


    public function __construct()
    { 

        $this->authUser = auth()->user(); //authenticated user
        
    }

    public function saveForm($data)
    {  
        //authenticated user
        $data['user_id'] = $this->authUser->id; 
        //form is public
        $data['is_public'] = true;  
        //save the form to db 
        try {
            Form::create($data); 

            return true; 
        }
        
        catch (Exception $e) {
           
            Log::error('Failed to save form: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data,
                'user_id' => $this->authUser ? $this->authUser->id : null,
            ]);

            throw $e;

            return false; 
        }


    }//endof function  


    //function to fetch all forms 

    public function getAllForms()
    {
        // Fetch all forms belonging to the authenticated user, ordered by latest
        return Form::where('user_id', $this->authUser->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }//endof function 


    public function updateForm($data)
     { 
     
    // Find the form by id and user_id to ensure ownership
    $form = Form::where('id', $data['id'])
                ->where('user_id', $this->authUser->id)
                ->first();

    if (!$form) {
        // Optionally, throw an exception or return false if not found
        return false;
    }

    // Update the form fields
    $form->title = $data['editingFormTitle'] ?? $data['title'] ?? $form->title;
    $form->description = $data['editingFormDescription'] ?? $data['description'] ?? $form->description;
    $form->category = $data['editingFormCategory'] ?? $data['category'] ?? $form->category;
    $form->status = $data['editingFormStatus'] ?? $data['status'] ?? $form->status;
    

    try {
        $form->save();
        return true;
    } 
    catch (Exception $e) {
        Log::error('Failed to update form: ' . $e->getMessage(), [
            'exception' => $e,
            'data' => $data,
            'user_id' => $this->authUser ? $this->authUser->id : null,
        ]);
        return false;
    }


    }//endof function

}

