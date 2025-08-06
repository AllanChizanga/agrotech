<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Services\UserService;
use Livewire\Attributes\Validate;

class DataCollectorsLivewire extends Component
{  

    //attributes 
   #[Validate('required')]
    public $name; 
   #[Validate('required')]
    public $email; 
    #[Validate('required')]
    public $password;  

    //edit attributes 

    // Edit attributes for editing a data collector
    public $edit_id;
    public $edit_name;
    public $edit_email;
    public $edit_password;

    //function to load data collectors 


    public $dataCollectors = [];

    /**
     * Load all users who are data collectors.
     */
    public function loadDataCollectors()
    {
        $service = new UserService();
        $this->dataCollectors = $service->getDataCollectors();
    }

  //mount function to fetch all the existing data collectors 


    public function mount()
    { 

      $this->loadDataCollectors();

    }  

    //function to delete a data collector 

    public function delete(User $user)
    {
        $user->delete(); 
        session()->flash('success', 'Data Collector deleted successfully.');
        $this->loadDataCollectors();
        $this->dispatch('data-collector-deleted');
    } 


    public function edit(User $user)
    { 

        // Fill the edit attributes with the selected user's data
        $this->edit_id = $user->id;
        $this->edit_name = $user->name;
        $this->edit_email = $user->email;
        $this->edit_password = ''; // Leave blank for security 
        $this->dispatch('open-edit-data-collector-modal');

    } 

    public function updateDataCollector()
    {
        $service = new UserService();

        $data = [
            'name' => $this->edit_name,
            'email' => $this->edit_email,
        ];

        // Only update password if provided
        if (!empty($this->edit_password)) {
            $data['password'] = $this->edit_password;
        }

        $data['id'] = $this->edit_id;
        $updated = $service->updateDataCollector($data);

        if ($updated) {
            $this->loadDataCollectors();

            session()->flash('success', 'Data Collector updated successfully.');

            $this->dispatch('data-collector-updated');
            
            // Optionally, reset edit fields
            $this->reset(['edit_id', 'edit_name', 'edit_email', 'edit_password']);
        } else {
            session()->flash('error', 'Failed to update Data Collector.');
        }
    }


    public function createDataCollector()
    {
        $data = [
            'name'=>$this->name, 
            'email'=>$this->email,
            'password'=>$this->password, 
        ];
           $service =   new UserService();
        $user = $service->createDataCollector($data);  

    if ($user) {
        $this->loadDataCollectors();
        session()->flash('success', 'Data Collector created successfully.');
        $this->dispatch('data-collector-created');
        // Optionally, you can reset the form fields
        $this->reset(['name', 'email', 'password']);
    } else {
        session()->flash('error', 'Failed to create Data Collector.');
    }

    }


    public function render()
    {
        return view('livewire.data-collectors-livewire');
    }
}
