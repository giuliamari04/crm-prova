<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;
use Livewire\WithPagination;

class ClientsTable extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $nameFilter = '';
    public $surnameFilter = '';
    public $statusFilter = '';
    public $emailFilter='';
    public $phoneFilter='';

    public $cfFilter='';

    public $industryFilter='';
    public $companyFilter='';
   // public $clients;
    public $industries;

    public $companies;
    public $clientDeleteId = null;
    public function mount()
    {
        $this->companies = Company::all();
        // $clients = Client::paginate(4);
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

        $this->clients = $query;
        $clients = $this->clients->paginate(4);
        return view('livewire.clients-table', [
            'clients' => $clients,
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

public function deleteClient($id)
{
    // Metodo per eliminare il cliente
    Client::find($id)->delete();
    session()->flash('message', 'Cliente eliminato con successo.');
    return redirect()->route('admin.home');

}

}
