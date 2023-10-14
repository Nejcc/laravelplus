<?php

namespace App\Http\Controllers;

use App\Models\InterfaceUsage;
use App\Http\Requests\StoreInterfaceUsageRequest;
use App\Http\Requests\UpdateInterfaceUsageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class InterfaceUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterfaceUsageRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InterfaceUsage $interfaceUsage): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InterfaceUsage $interfaceUsage): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterfaceUsageRequest $request, InterfaceUsage $interfaceUsage): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InterfaceUsage $interfaceUsage): RedirectResponse
    {
        //
    }
}
