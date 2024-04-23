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
            $query->where('company_id', $this->companyFilter);
        }


        $this->clients = $query->get();

        return view('livewire.clients-table', [
            'clients' => $this->clients,
            'industries' => $this->industries,
            'companies' => $this->companies,
        ]);
    }
    public function resetForm(){
        // Resetta i valori dei filtri nel componente Livewire
        $this->nameFilter = '';
        $this->surnameFilter = '';
        $this->emailFilter = '';
        $this->phoneFilter = '';
        $this->cfFilter = '';
        $this->industryFilter = '';
        $this->statusFilter = '';
        $this->companyFilter = '';

        // Aggiorna i risultati della query e la tabella
        $this->refreshClients();
    }
    public function refreshClients()
    {
        $this->render();
    }

    public function redirectToCratePage()
    {
        return redirect()->route('admin.client.create');
    }
    public function redirectToDetailPage($clientId)
    {
        return redirect()->route('admin.client.show', ['id' => $clientId]);
    }

    public function redirectToEditPage($clientId)
    {
        return redirect()->route('admin.client.edit', ['id' => $clientId]);
    }

    public function confirmDelete($clientId)
    {
       $this->emit('confirm-delete', $clientId);
    }

    public function deleteClient($clientId)
    {
        // Codice per eliminare effettivamente il cliente
    Client::find($clientId)->delete();
    // Chiudi la modale dopo l'eliminazione
    $this->emit('close-delete-modal');
    // Aggiorna la tabella dopo l'eliminazione
    $this->refreshClients();
    }


}
