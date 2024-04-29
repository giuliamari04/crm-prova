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
    public $company_id;
   public $pIva;
   public $start;
   public $end;

   protected $rules = [
    'company_id'=>'required',
        'firstName' => 'required|min:2|max:50',
        'lastName' => 'required|min:2|max:50',
        //'email' => 'required|email',
        'email' => 'required|email|unique:clients,email',
        'cf' => 'required|min:10|max:15',
        'phone' => 'required|min:10|max:15',
        'start'=>'nullable',
        'industry'=>'required|min:2|max:50',
        'end'=>'nullable',
        'pIva'=>'nullable|min:7|max:12',

];

protected $messages = [
    'firstName.required' => 'Il nome è obbligatorio.',
    'firstName.min' => 'Il nome deve essere lungo almeno :min caratteri.',
    'firstName.max' => 'Il nome non può superare :max caratteri.',
    'lastName.required' => 'Il cognome è obbligatorio.',
    'lastName.min' => 'Il cognome deve essere lungo almeno :min caratteri.',
    'lastName.max' => 'Il cognome non può superare :max caratteri.',
    'email.required' => 'L\'indirizzo email è obbligatorio.',
    'email.email' => 'L\'indirizzo email non è valido.',
    'email.min' => 'L\'indirizzo email deve essere lungo almeno :min caratteri.',
    'email.max' => 'L\'indirizzo email non può superare :max caratteri.',
    'email.unique' => 'L\'indirizzo email è già in uso.',
    'cf.required' => 'Il codice fiscale è obbligatorio.',
    'cf.min' => 'Il codice fiscale deve essere lungo almeno :min caratteri.',
    'cf.max' => 'Il codice fiscale non può superare :max caratteri.',
    'phone.required' => 'Il numero di telefono è obbligatorio.',
    'phone.min' => 'Il numero di telefono deve essere lungo almeno :min caratteri.',
    'phone.max' => 'Il numero di telefono non può superare :max caratteri.',
    'company_id.required' => 'Seleziona un\'azienda.',

];
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
          $this->company_id = $this->client->company_id;
          $this->firstName = $this->client->first_name;
          $this->lastName = $this->client->last_name;
          $this->email = $this->client->email;
          $this->phone = $this->client->phone;
          $this->cf = $this->client->codice_fiscale;
          $this->pIva = $this->client->p_iva;
          $this->industry = $this->client->industry;
          $this->status = $this->client->status;
          $this->start = $this->client->contract_start_date;
          $this->end = $this->client->contract_end_date;


        // Recupera le aziende associate al cliente
        $this->companies = Company::all();
        $this->company_id = $this->client->company_id;
        //$this->companyName = $this->companies->first()->name;
        //dd($this->companies);
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
            'company_id' => 'required'
        ]);

        $selectedCompany = Company::where('name', $this->company_id)->first();
        // Aggiorna i dati del cliente con i nuovi valori
        $this->client->update([
            'company_id'=>$this->company_id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email'=>$this->email,
            'codice_fiscale'=>$this->cf,
            'phone'=>$this->phone,
            'p_iva'=>$this->pIva,
            'status'=>$this->status,
            'industry'=>$this->industry,
            'contract_start_date'=>$this->start,
            'contract_end_date'=>$this->end,
        ]);

        // Mostra un messaggio di successo
        session()->flash('message', 'I dati del cliente sono stati aggiornati con successo.');

        // Redireziona alla pagina di dettaglio del cliente
        return redirect()->route('admin.client.show', [
            'id' => $this->client->id,
        ]);
    }
}
