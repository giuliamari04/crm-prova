<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class CreateClient extends Component
{
    // Proprietà per i dati del nuovo cliente
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $cf;
    public $pIva;
    public $start;
    public $end;
    public $company_id;
    public $status;
    public $industry;

    public $companies;

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
    public function render()
    {
        $this->companies = Company::all();


        return view('livewire.create-clients',[
            'companies' => $this->companies,
        ]);

    }

    public function save()
    {
        // Valida i dati del cliente
        $this->validate([
            'company_id'=>'required',
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|email',
            // 'email' => 'required|email|unique:clients,email',
            'cf' => 'required|min:10|max:15',
            'phone' => 'required|min:10|max:15',
            'start'=>'nullable',
            'end'=>'nullable',
            'pIva'=>'nullable',

        ]);
        $selectedCompany = Company::where('name', $this->company_id)->first();

        // Salva i dati del nuovo cliente nel database
        $client = Client::create([
            'company_id'=>$this->company_id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'codice_fiscale' => $this->cf,
            'phone' => $this->phone,
            'industry'=>$this->industry,
            'p_iva' => $this->pIva,
            'status'=>$this->status,
            'contract_start_date' => $this->start,
            'contract_end_date' => $this->end,
        ]);


        // Mostra un messaggio di successo
        session()->flash('message', 'Il cliente è stato creato con successo.');

        // Reindirizza alla pagina di dettaglio del nuovo cliente
        return redirect()->route('admin.home');
    }
}
