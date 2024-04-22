<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class DetailsClient extends Component
{
    public $client;
    public $industries;

    public $companies;


    public function mount($id)
    {
        $this->client = Client::where('id',$id)->get();
        $this->companies = Company::where('client_id', $id)->get();
        $this->industries = Client::pluck('industry')->unique()->filter();
    }
    public function render()
    {

        return view('livewire.details-clients', [
            'clients' => $this->client,
            'industries' => $this->industries,
            'companies' => $this->companies,
        ]);
    }


}
