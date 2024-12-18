<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return ServiceRequest::all();
    }

    public function service_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $service_requests = ServiceRequest::all();

        $services = auth() -> user() -> services;
        return view('service.requests.index', compact('service_requests', 'services'));
    }

    public function client_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = Auth::user();
        $service_requests = $user->service_requests;
        return view('client.requests.index', compact('service_requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $user = auth()->user();
        $cars = $user->cars;
        return view('client.requests.create', compact('cars',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('attachments')) {

            $request->validate([
                'attachments.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $attachments = [];

            // Обрабатываем файлы
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('attachments'), $filename);
                $attachments[] = '/attachments/' . $filename;
            }
            ServiceRequest::create([
                'user_id' => auth()->id(),
                'car_id' => $request->car_id,
                'problem_description' => $request->problem_description,
                'urgency' => $request->urgency,
                'status' => 'waiting',
                'location' => $request->location,
                'attachments' => $attachments,
            ]);


            return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało dodane pomyślnie');
        }

        // Если файлов нет, можно вернуть ошибку
        return redirect()->back()->withErrors(['attachments' => 'Żadne pliki nie zostały przesłane']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceRequest $service_request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('client.requests.show', compact('service_request'));
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(ServiceRequest $service_request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $this->authorize('edit', $service_request);
        return view('client.requests.edit', compact('service_request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $service_request): \Illuminate\Http\RedirectResponse
    {
        $input = [
            'problem_description' => $service_request->problem_description,
            'urgency' => $service_request->urgency,
            'status' => 'in progress',
            'location' => $service_request->location,
        ];

        $this->authorize('update', $service_request);
        $service_request->update($input);

        return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało pomyślnie zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRequest $service_request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $service_request);

        $service_request->delete();
        return redirect()->route('client.requests')->with('status', 'Zgłoszenie zostało pomyślnie anulowane');
    }
}
