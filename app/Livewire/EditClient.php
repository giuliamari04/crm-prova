<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class EditClient extends Component
{
    public $client;
    public $industries;
    public $companies;

    // Proprietà per i dati del cliente modificati
    public $firstName;
    public $lastName;
   public $email;
   public $phone;
   public $cf;
   public $industry;
   public $status;
   public $companyName;

   public $pIva;
   public $start;
   public $end;
    public function mount($id)
    {
        // Recupera il singolo cliente utilizzando l'ID
        $this->client = Client::find($id);

        // Verifica se il cliente è stato trovato
        if (!$this->client) {
            // Puoi gestire il caso in cui il cliente non esiste
            abort(404, 'Cliente non trovato');
        }
          // Inizializza i campi del form con i valori attuali del cliente
          $this->firstName = $this->client->first_name;
          $this->lastName = $this->client->last_name;
          $this->email = $this->client->email;
          $this->phone = $this->client->phone;
          $this->cf = $this->client->codice_fiscale;
          $this->pIva = $this->client->p_iva;
          $this->start = $this->client->contract_start_date;
          $this->end = $this->client->contract_end_date;


        // Recupera le aziende associate al cliente
        $this->companies = Company::where('client_id', $id)->get();
        $this->companyName = $this->companies->first()->name;
        // Recupera le industrie per il dropdown
        $this->industries = Client::pluck('industry')->unique()->filter();
    }

    public function render()
    {
        return view('livewire.edit-clients', [
            'client' => $this->client,
            'industries' => $this->industries,
            'companies' => $this->companies,
        ]);
    }

    public function save()
    {

        // Valida i dati del cliente
        $this->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|min:8|max:50',
            'cf'=>'required|min:10|max:15',
            'phone'=>'required|min:10|max:15',
            'companyName'=>'required|min:2|max:50',
        ]);

        // Aggiorna i dati del cliente con i nuovi valori
        $this->client->update([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email'=>$this->email,
            'codice_fiscale'=>$this->cf,
            'phone'=>$this->phone,
            'p_iva'=>$this->pIva,
            'contract_start_date'=>$this->start,
            'contract_end_date'=>$this->end,
        ]);

        // Aggiorna i dati dell'azienda con i nuovi valori
        if ($this->companies->isNotEmpty()) {
            $company = $this->companies->first();
            $company->update([
                'name' => $this->companyName,
            ]);
        }

        // Mostra un messaggio di successo
        session()->flash('message', 'I dati del cliente sono stati aggiornati con successo.');

        // Redireziona alla pagina di dettaglio del cliente
        return redirect()->route('admin.client.show', ['id' => $this->client->id]);
    }
}
