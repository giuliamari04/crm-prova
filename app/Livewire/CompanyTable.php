<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;
use Livewire\WithPagination;

class CompanyTable extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $nameFilter = '';
    public $statusFilter = '';
    public $emailFilter='';
    public $phoneFilter='';

    public $industryFilter='';
    public $addressFilter='';

    public $cityFilter='';
    public $postal_codeFilter='';
    public $provinceFilter='';
    public $countryFilter='';
    public $websiteFilter='';
   // public $clients;
    public $industries;

    public $clients;
    public $companyDeleteId = null;
    public function mount()
    {
        $this->clients = Client::all();
        // $clients = Client::paginate(4);
        $this->industries = Company::pluck('industry')->unique()->filter();
    }
    public function render()
    {
        $query = Company::query();

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->industryFilter) {
            $query->where('industry', $this->industryFilter);
        }

        if ($this->nameFilter) {
            $query->where('name', 'like', '%'.$this->nameFilter.'%');
        }

        if ($this->emailFilter) {
            $query->where('email', 'like', '%'.$this->emailFilter.'%');
        }
        if ($this->phoneFilter) {
            $query->where('phone_number', 'like', '%'.$this->phoneFilter.'%');
        }
        if ($this->addressFilter) {
            $query->where('address', 'like', '%'.$this->addressFilter.'%');
        }

        if ($this->cityFilter) {
            $query->where('city', 'like', '%'.$this->cityFilter.'%');
        }
        if ($this->postal_codeFilter) {
            $query->where('postal_code', 'like', '%'.$this->postal_codeFilter.'%');
        }
        if ($this->provinceFilter) {
            $query->where('province', 'like', '%'.$this->provinceFilter.'%');
        }

        if ($this->countryFilter) {
            $query->where('country', 'like', '%'.$this->countryFilter.'%');
        }
        if ($this->websiteFilter) {
            $query->where('website', 'like', '%'.$this->websiteFilter.'%');
        }
        $this->companies = $query;
        $companies = $this->companies->paginate(4);
        return view('livewire.company-table', [
            'companies' => $companies,
            'industries' => $this->industries,
            'clients' => $this->clients,
        ]);
    }
    public function resetForm(){
        // Resetta i valori dei filtri nel componente Livewire
        $this->nameFilter = '';
        $this->emailFilter = '';
        $this->phoneFilter = '';
        $this->postal_codeFilter = '';
        $this->industryFilter = '';
        $this->statusFilter = '';
        $this->cityFilter = '';
        $this->addressFilter = '';
        $this->provinceFilter = '';
        $this->countryFilter = '';

        // Aggiorna i risultati della query e la tabella
        $this->refreshCompanies();
    }
    public function refreshCompanies()
    {
        $this->render();
    }

    public function redirectToCreatePage()
    {
        return redirect()->route('admin.company.create');
    }
    public function redirectToDetailPage($companyId)
    {
        return redirect()->route('admin.company.show', ['id' => $companyId]);
    }

    public function redirectToEditPage($companyId)
    {
        return redirect()->route('admin.company.edit', ['id' => $companyId]);
    }

public function deleteClient($id)
{
    // Metodo per eliminare il cliente
    Client::find($id)->delete();
    session()->flash('message', 'Cliente eliminato con successo.');
    return redirect()->route('admin.home');

}

}
