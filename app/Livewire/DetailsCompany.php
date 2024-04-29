<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class DetailsCompany extends Component
{
    public $clients;
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
            'clients' => $this->clients,
            'industries' => $this->industries,
            'companies' => $this->companies,
        ]);
    }

    public function refreshCompanies()
    {
        $this->render();
    }
    public function redirectToDetailPage($companyId)
    {
        return redirect()->route('admin.company.show', ['id' => $companyId]);
    }

    public function redirectToEditPage($clientId)
    {
        return redirect()->route('admin.company.edit', ['id' => $clientId]);
    }

    public function confirmDelete($clientId)
    {
        // Mostra un messaggio di conferma prima di eliminare il cliente
        if (confirm('Sei sicuro di voler eliminare questo cliente?')) {
            $this->deleteClient($clientId);
        }
    }

    public function deleteCompany($id)
    {
        // Metodo per eliminare il cliente
        Company::find($id)->delete();
        session()->flash('message', 'Azienda eliminata con successo.');
        return redirect()->route('admin.company');

    }

}
