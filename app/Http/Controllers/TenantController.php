<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;

class TenantController extends Controller
{
    public function index() 
    {
        $tenants = Tenant::with('domain')->get();
        return view('tenant.index', compact('tenants'));
    }

    public function create() 
    {
        return view('tenant.create');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            "name"      => "required|string|min:3|max:10",
            "subdomain" => "required|string|min:3|max:10|unique:tenants,id,'regex:/\s/'",
            "users"     => "required|numeric|min:1|max:10"
        ]);

        $subdomain      = $request->subdomain;
        $subdomain_link = $subdomain.'.localhost';

        $tenant = \App\Models\Tenant::create(['id' => $subdomain]);
        $tenant->domains()->create(['domain' => $subdomain_link]);

        $tenant->run(function () {
            User::factory(rand(1,10))->create();
        });

        return redirect($subdomain_link.':8000');
        // return redirect()->back()->with('success', 'App registered successfully.');
    }

    public function edit(Tenant $tenant, Request $request)
    {
        return view('tenant.edit', compact('tenant'));
    }

    public function update(Tenant $tenant, Request $request)
    {
        $this->validate($request, [
            "name"      => "required|string|min:3|max:10",
            "subdomain" => "required|string|min:3|max:10|unique:tenants,id,'regex:/\s/',".$tenant->id,
        ]);

        $subdomain      = $request->subdomain;
        $subdomain_link = $subdomain.'.localhost';

        $tenant->update(['id' => $subdomain]);
        $tenant->domains()->update(['domain' => $subdomain_link]);

        return redirect()->back()->with('success', 'Tenant updated successfully.');
    }
}
