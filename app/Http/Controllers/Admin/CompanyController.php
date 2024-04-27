<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Client;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company.home');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        $clients = Client::where('company_id', $company->id)->get();
        return view('admin.company.show', compact('clients', 'company'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

     public function create()
    {
        return view('admin.company.create');
    }
    public function destroy(Company $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('admin.company')->with('success', 'azienda eliminata con successo.');
    }
}
