<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{ 

    public $service;
    public function __construct(UserService $service)
    { 

        $this->service = $service;
       
    }

    public function login()
    {
        return view('login');
    } 

    public function authenticate(LoginRequest $request)
    { 

        //validate  

        $data = $request->validated(); 


        //service  

       $res =  $this->service->authenticateWeb($data,$request);

        //response  

        if($res)
        { 

            return redirect()->route('dashboard');

        }
        return back()->with('error','Invalid Credentials');
    }

 
   
}
