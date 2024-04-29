<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Mail;

use Livewire\Component;
use App\Models\Client;
use App\Models\Company;
use App\Models\Activity;
use App\Models\Interaction;
use App\Models\Financial;

use App\Mail\NewMail;


class DetailsClient extends Component
{
    public $client;
    public $industries;
    public $companies;
    public $activities;
    public $financials;
    public $interactions;
    public function mount($id)
    {
        $this->client = Client::where('id',$id)->get();
        $this->companies = Company::all();
        $this->activities = Activity::where('client_id',$id)->get();
        $this->interactions = Interaction::where('client_id',$id)->get();
        $this->financials = Financial::where('client_id',$id)->get();
        $this->industries = Client::pluck('industry')->unique()->filter();
    }
    public function render()
    {

        return view('livewire.details-clients', [
            'clients' => $this->client,
            'activities'=>$this->activities,
            'interactions'=>$this->interactions,
            'industries' => $this->industries,
            'financials'=>$this->financials,
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

    public function deleteClient($clientId)
    {
           // Metodo per eliminare il cliente
    Client::find($clientId)->delete();
    session()->flash('message', 'Cliente eliminato con successo.');
    return redirect()->route('admin.home');

    }

    public function sendMail($clientId){
       // $this->sendEmail($clientId);
       $client = Client::find($clientId);

       // Invia l'email utilizzando il componente NewMail
       Mail::to($client->email)->send(new NewMail($client->first_name, $client->last_name));

       // Flash message di conferma
       session()->flash('message', 'Email inviata con successo!');
    }

}
