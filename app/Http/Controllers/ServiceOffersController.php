<?php

namespace App\Http\Controllers;

use App\Models\ServiceOffer;
use Illuminate\Http\Request;

class ServiceOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return ServiceOffer::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('services.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        ServiceOffer::create([
            'service_request_id' => $request->service_request_id,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'description' => $request->description,
            'available_slots' => null,
        ]);

        return redirect()->route('service.requests')->with('status', 'Oferta została wysłana');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOffer $service_offers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOffer $service_offers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceOffer $service_offer): \Illuminate\Http\RedirectResponse
    {
        $input = [
            'service_request_id' => $request->service_request_id,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'description' => $request->description,
            'available_slots' => null,
        ];


        $service_offer->update($input);

        return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało pomyślnie zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOffer $service_offers)
    {
        //
    }
}
