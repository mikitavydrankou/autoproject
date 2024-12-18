<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Car::all();
    }

    public function user_cars(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = Auth::user();
        if ($user) {
            $cars = $user->cars;
            return view('client.cars.index', compact('cars'));
        }
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('client.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = '/images/'.$imageName;
        } else {
            $imagePath = '/images/default_car.jpg';
        }

        if (!is_numeric($request->mileage)) {
            return redirect()->back()->withErrors(['mileage' => 'Mileage must be a number']);
        }
        Car::create([
            'user_id' => Auth::id(),
            'make' => $request -> make,
            'model' => $request -> model,
            'year' => $request -> year,
            'license_plate' => $request -> license_plate,
            'engine_type' => $request -> engine_type,
            'transmission' => $request -> transmission,
            'mileage' => $request -> mileage,
            'last_service_date' => $request -> last_service_date,
            'image' => $imagePath,
        ]);

       return redirect()->route('my-cars')->with('status', 'Maszyna została dodana pomyślnie');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $car = Car::findOrFail($id);
        return view('client.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $car = Car::findOrFail($id);
        return view('client.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $car = Car::findOrFail($request->id);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = '/images/'.$imageName;
        } else {
            $imagePath = $car->image;
        }

        if (!is_numeric($request->mileage)) {
            return redirect()->back()->withErrors(['mileage' => 'Przebieg musi być liczbą']);
        }

        $input = [
            'user_id' => Auth::id(),
            'make' => $request -> make,
            'model' => $request -> model,
            'year' => $request -> year,
            'license_plate' => $request -> license_plate,
            'engine_type' => $request -> engine_type,
            'transmission' => $request -> transmission,
            'mileage' => $request -> mileage,
            'last_service_date' => $request -> last_service_date,
            'image' => $imagePath,
        ];

        $car->update($input);

        return redirect('home')->with('status', 'Samochód został zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $car = Car::findOrFail($id);

        if ($car->serviceRequests()->exists()) {
            return redirect()->route('my-cars')->withErrors(['error' => 'Nie możesz usunąć samochodu, jeśli istnieją zgłoszenia ']);
        }
        $car->delete();
        return redirect()->route('my-cars')->with('status', 'Samochód został usunięty!');
    }
}
