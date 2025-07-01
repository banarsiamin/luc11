<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Company::all();
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
        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
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
        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(null, 204);
    }
}
