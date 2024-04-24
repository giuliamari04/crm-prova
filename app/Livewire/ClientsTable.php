<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;
use Livewire\WithPagination;

class ClientsTable extends Component
{
    use WithPagination;
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
    protected $listeners = ['confirmDelete'];
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


        // $this->clients = $query->paginate(4);
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
    // Passa l'ID del cliente alla vista per poterlo utilizzare nel tuo script JavaScript
    $this->clientId = $clientId;
    $this->showDeleteModal = true;
}

public function deleteClient()
{
    // Metodo per eliminare il cliente
    $client = Client::findOrFail($this->clientId);
    $client->delete();
    // Reindirizza alla home
    return redirect()->route('admin.home')->with('success', 'Cliente eliminato con successo.');
}

}
