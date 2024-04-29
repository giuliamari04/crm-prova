<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;

class CreateCompany extends Component
{
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

    public function render()
    {
        return view('livewire.create-companies');

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



        // Salva i dati del nuovo cliente nel database
        $company = Company::create([
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
        session()->flash('message', 'L\'azienda è stata creata con successo.');

        // Reindirizza alla pagina di dettaglio del nuovo cliente
        return redirect()->route('admin.company.home');
    }
}
