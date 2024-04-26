<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Client;
use App\Models\Activity;
use App\Models\Financial;
use App\Models\Interaction;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company.home');
    }

    public function show($id)
    {
        // Metodo per visualizzare i dettagli di un companye
        $company = Company::findOrFail($id);
        $clients = Client::where('company_id', $company->id)->get();
        return view('admin.company.show', compact('clients', 'company'));
    }

    public function edit($id)
    {
        // Metodo per visualizzare il formulario di modifica di un companye
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

     public function create()
    {
        // Metodo per visualizzare il formulario per creare un nuovo companye
        return view('admin.company.create');
    }
    public function destroy(Company $id)
    {
        // Metodo per eliminare un companye
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('admin.company')->with('success', 'companye eliminato con successo.');
    }
}
