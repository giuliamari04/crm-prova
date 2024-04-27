<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class EditCompany extends Component
{
    public $clients;
    public $industries;
    public $company;
    public $name;
   public $email;
   public $phone;
   public $industry;
   public $status;
    public $address;
   public $city;
   public $postal_code;
   public $province;
   public $country;
   public $website;

    public function mount($id)
    {
        // Recupera il singolo cliente utilizzando l'ID
        $this->company = Company::find($id);

        // Verifica se il cliente è stato trovato
        if (!$this->company) {
            // Puoi gestire il caso in cui il cliente non esiste
            abort(404, 'Azienda non trovato');
        }
          // Inizializza i campi del form con i valori attuali del cliente
          $this->name = $this->company->name;
          $this->email = $this->company->email;
          $this->phone = $this->company->phone_number;
          $this->industry = $this->company->industry;
          $this->status = $this->company->status;
          $this->city = $this->company->city;
          $this->address = $this->company->address;
          $this->postal_code = $this->company->postal_code;
          $this->province = $this->company->province;
          $this->country = $this->company->country;
          $this->website = $this->company->website;


        $this->industries = Client::pluck('industry')->unique()->filter();
    }

    public function render()
    {
        return view('livewire.edit-company', [
            'industries' => $this->industries,
            'companies' => $this->company,
        ]);
    }

    public function save()
    {

        // Valida i dati del cliente
        $this->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|min:8|max:50',
            'phone'=>'required|min:10|max:15',
            'industry'=>'required',
            'address' => 'required',
            'city'=>'required',
            'province'=>'required',
            'postal_code'=>'required',
            'country'=>'required',
            'website'=>'nullable',
            'status'=>'required',
        ]);

        // Aggiorna i dati del cliente con i nuovi valori
        $this->company->update([

            'name' => $this->name,
            'email'=>$this->email,
            'phone_number'=>$this->phone,
            'status'=>$this->status,
            'industry'=>$this->industry,
            'address'=>$this->address,
            'city'=>$this->city,
            'postal_code'=>$this->postal_code,
            'province'=>$this->province,
            'country'=>$this->country,
            'website'=>$this->website,

        ]);

        // Mostra un messaggio di successo
        session()->flash('message', 'I dati dell\' azienda sono stati aggiornati con successo.');

        // Redireziona alla pagina di dettaglio del cliente
        return redirect()->route('admin.company.show', [
            'id' => $this->company->id,
        ]);
    }
}
