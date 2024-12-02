<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as FormRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function my_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = Auth::user();
        if ($user && $user->role_id === 2) {
            $requests = $user->requests()->with('car')->get();
            return view('my-requests.index', compact('requests'));
        }
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function my_create()
    {
        $user = auth()->user();
        $cars = $user->cars;
        return view('my-requests.create', compact('cars',));
    }



public function my_store(FormRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
{
    if ($request->hasFile('attachments')) {
        // Валидация для всех загружаемых файлов
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

        // Создаем новый запрос
        Request::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
            'problem_description' => $request->problem_description,
            'urgency' => $request->urgency,
            'status' => 'in progress',
            'location' => $request->location,
            'attachments' => $attachments,
        ]);

        return redirect('home')->with('status', 'Заявка успешно добавлена');
    }

    // Если файлов нет, можно вернуть ошибку
    return redirect()->back()->withErrors(['attachments' => 'Не были загружены файлы.']);
}


    public function show($id)
    {
        $request = Request::find($id);
        return view('requests.show', ['request' => $request]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
