<?php

namespace App\Services;

use Log;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
   
    public function __construct()
    {
        
    } 
 

    //authenticateWeb  

    public function authenticateWeb($data,$request)
    { 

          //validate 

          $credentials = $data;

        //auth attempt 

        if(Auth::attempt($credentials))
        {
            //session token 
            $request->session()->regenerate(); 

            //redirect 

            return true;


        }
        
       return false;

    } 

    public function createDataCollector($data) 
    {
        $data['password'] = Hash::make($data['password']); 

        $data['role'] = 'data-collector';  

        try {
            $user = User::create($data);
            return $user; 
        } catch (Exception $e) {
            // Handle the exception as needed, e.g., log or rethrow
            Log::error('Failed to create data collector', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
            throw $e;
        }


    }//endof function 

public function getDataCollectors()
{
    return User::where('role', 'data-collector')->get();
} 

public function updateDataCollector($data)
{
    try {
        $user = User::find($data['id']);
        if (!$user) {
            return false;
        }

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return true;
        
    } catch (Exception $e) {
        Log::error('Failed to update data collector', [
            'error' => $e->getMessage(),
            'data' => $data,
        ]);
        return false;
    }
}


}//endof clas
