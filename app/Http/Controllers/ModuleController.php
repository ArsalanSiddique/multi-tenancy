<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $modules = Module::All();
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tenants = Tenant::with('domain')->get();
        return view('modules.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            "tenant_id"     => "required|string|exists:tenants,id",
            "name"          => "required|string|unique:modules,id"
        ]);


        if(!Module::where(['tenant_id' => $request->tenant_id, 'name' => $request->name])->first()) {
            $module                 = new Module();
            $module->tenant_id      = $request->tenant_id;
            $module->name           = $request->name;
            $module->save();
    
            return redirect()->back()->with('success', 'Module added successfully.');
        } else {
            return redirect()->back()->with('info', 'Module already assigned.');
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module): RedirectResponse
    {
        $this->validate($request, [
            "tenant_id"     => "required|numeric|exists:tenants,id",
            "name"          => "required|string|unique:modules,id"
        ]);

        $module->tenant_id      = $request->tenant_id;
        $module->module         = $request->module;
        $module->save();

        return redirect()->back()->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module): RedirectResponse
    {
        $module->delete();
        return redirect()->back()->with('success', 'Module revoke successfully.');
    }
}
