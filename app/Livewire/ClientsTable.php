<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class ClientsTable extends Component
{
    public $nameFilter = '';
    public $surnameFilter = '';
    public $statusFilter = '';
    public $emailFilter='';
    public $phoneFilter='';

    public $cfFilter='';

    public $industryFilter='';
    public $companyFilter='';
    public $clients;
    public $industries;

    public $companies;


    public function mount()
    {
        $this->companies = Company::all();
        $this->clients = Client::all();
        $this->industries = Client::pluck('industry')->unique()->filter();
    }

    public function render()
    {
        $query = Client::query();

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->industryFilter) {
            $query->where('industry', $this->industryFilter);
        }

        if ($this->nameFilter) {
            $query->where('first_name', 'like', '%'.$this->nameFilter.'%');
        }

        if ($this->surnameFilter) {
            $query->where('last_name', 'like', '%'.$this->surnameFilter.'%');
        }

        if ($this->emailFilter) {
            $query->where('email', 'like', '%'.$this->emailFilter.'%');
        }
        if ($this->phoneFilter) {
            $query->where('phone', 'like', '%'.$this->phoneFilter.'%');
        }
        if ($this->cfFilter) {
            $query->where('codice_fiscale', 'like', '%'.$this->cfFilter.'%');
        }

        if ($this->companyFilter) {
            $query->where('id', $this->companyFilter);
        }


        $this->clients = $query->get();

        return view('livewire.clients-table', [
            'clients' => $this->clients,
            'industries' => $this->industries,
            'companies' => $this->companies,
        ]);
    }

    public function refreshClients()
    {
        $this->render();
    }

    public function redirectToPage(){
        return redirect()->route('dettaglio-cliente');
    }
}
