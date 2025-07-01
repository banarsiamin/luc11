<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Middleware\CheckCompanyAccess;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->expectsJson() || request()->header('Accept') === 'application/json') {
            return Company::all();
        }
        
        return view('company_list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'address' => 'nullable|string',
            'website' => 'nullable|string',
        ]);
        $company = Company::create($validated);
        
        if ($request->expectsJson() || $request->header('Accept') === 'application/json') {
            return response()->json($company, 201);
        }
        
        return redirect('/company/list')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        
        if (request()->expectsJson() || request()->header('Accept') === 'application/json') {
            return response()->json($company);
        }
        
        return view('company_edit', ['id' => $id, 'company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:companies,email,' . $id,
            'address' => 'nullable|string',
            'website' => 'nullable|string',
        ]);
        $company->update($validated);
        
        if ($request->expectsJson() || $request->header('Accept') === 'application/json') {
            return response()->json($company);
        }
        
        return redirect('/company/list')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        
        if (request()->expectsJson() || request()->header('Accept') === 'application/json') {
            return response()->json(null, 204);
        }
        
        return redirect('/company/list')->with('success', 'Company deleted successfully.');
    }
}
