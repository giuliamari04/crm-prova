<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class DetailsCompany extends Component
{
    public $client;
    public $industries;
    public $companies;

    public function mount($id)
    {
        $this->companies = Company::where('id',$id)->get();
        $this->clients = Client::all();
        $this->industries = Company::pluck('industry')->unique()->filter();
    }
    public function render()
    {

        return view('livewire.details-companies', [
            'clients' => $this->client,
            'industries' => $this->industries,
            'companies' => $this->companies,
        ]);
    }


    public function redirectToDetailPage($companyId)
    {
        return redirect()->route('admin.client.show', ['id' => $companyId]);
    }

    public function redirectToEditPage($clientId)
    {
        return redirect()->route('admin.client.edit', ['id' => $clientId]);
    }

    public function confirmDelete($clientId)
    {
        // Mostra un messaggio di conferma prima di eliminare il cliente
        if (confirm('Sei sicuro di voler eliminare questo cliente?')) {
            $this->deleteClient($clientId);
        }
    }

    public function deleteClient($clientId)
    {
        // Codice per eliminare effettivamente il cliente
        Client::find($clientId)->delete();
        $this->refreshClients(); // Aggiorna la tabella dopo l'eliminazione
    }

}
