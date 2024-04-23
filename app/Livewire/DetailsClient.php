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
        $this->companies = Company::all();
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
