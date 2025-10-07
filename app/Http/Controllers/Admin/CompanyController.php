<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //get all products
        $companies = Company::latest()->paginate(10);

        //render view with products
        // return view('products.index', compact('products'));
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.add_company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'         => 'required',
            'company'       => 'required',
            'phone'         => 'required',
            'address'       => 'required',
            'logo'          => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload image
        $logo = $request->file('logo');
        $logo->storeAs('logo', $logo->hashName());

        //create product
        Company::create([
            'logo'          => $logo->hashName(),
            'email'         => $request->email,
            'company'       => $request->company,
            'phone'         => $request->phone,
            'address'       => $request->address,
        ]);

        //redirect to index
        return redirect()->route('company.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
