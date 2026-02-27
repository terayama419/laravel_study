<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Manufacturer::query()->whereNull('deleteTimestamp');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $manufacturers = $query
            ->with(['foods' => function ($q) {
                $q->whereNull('deleteTimestamp');
            }])
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->query());

        return view('manufacturers.index', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'businessHours' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:50'],
            'representativeName' => ['nullable', 'string', 'max:255'],
        ]);

        Manufacturer::create($validated);

        return redirect()->route('manufacturers.index')->with('status', 'Manufacturer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer)
    {
        if ($manufacturer->deleteTimestamp) {
            abort(404);
        }

        return view('manufacturers.edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        if ($manufacturer->deleteTimestamp) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'businessHours' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:50'],
            'representativeName' => ['nullable', 'string', 'max:255'],
        ]);

        $manufacturer->update($validated);

        return redirect()->route('manufacturers.index')->with('status', 'Manufacturer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        if ($manufacturer->deleteTimestamp) {
            return redirect()->route('manufacturers.index');
        }

        $now = now();

        $manufacturer->update([
            'deleteTimestamp' => $now,
        ]);

        $manufacturer->foods()
            ->whereNull('deleteTimestamp')
            ->update(['deleteTimestamp' => $now]);

        return redirect()->route('manufacturers.index')->with('status', 'Manufacturer and related foods deleted (soft delete).');
    }
}
