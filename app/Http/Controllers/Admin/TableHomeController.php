<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Activity;
use App\Models\Financial;
use App\Models\Interaction;
use Illuminate\Http\Request;

class TableHomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function show($id)
    {
        // Metodo per visualizzare i dettagli di un cliente
        $client = Client::findOrFail($id);
        $companies = Company::where('client_id', $id)->get();
        return view('admin.client.show', compact('client', 'companies'));
    }

    public function edit($id)
    {
        // Metodo per visualizzare il formulario di modifica di un cliente
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    public function create()
    {
        // Metodo per visualizzare il formulario per creare un nuovo cliente
        return view('admin.client.create');
    }
    public function destroy($id)
    {
        // Metodo per eliminare un cliente
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Cliente eliminato con successo.');
    }
}
