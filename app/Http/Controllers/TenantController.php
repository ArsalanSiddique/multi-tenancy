<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;

class TenantController extends Controller
{
    public function index() 
    {
        return view('app.index');
    }

    public function create() 
    {
        return view('app.create');
    }

    public function store(Request $request) 
    {

        $this->validate($request, [
            "name"      => "required|string|min:3|max:10",
            "subdomain" => "required|string|min:3|max:10|unique:tenants,id,'regex:/\s/'",
            "users"     => "required|numeric|min:1|max:10"
        ]);

        $subdomain      = $request->subdomain;
        $subdomain_link = $subdomain.'.locahost';

        $tenant = \App\Models\Tenant::create(['id' => $subdomain]);
        $tenant->domains()->create(['domain' => $subdomain_link]);

        // $tenant = \App\Models\Tenant::create(['id' => 'foo']);
        // $tenant->domains()->create(['domain' => 'foo.localhost']);
        

        $tenant->run(function () {
            User::factory(rand(1,10))->create();
        });

        return redirect()->back()->with('success', 'App registered successfully.');

    }
}
