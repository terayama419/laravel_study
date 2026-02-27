<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supplier::query()->whereNull('deleteTimestamp');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $suppliers = $query
            ->with(['foods' => function ($q) {
                $q->whereNull('deleteTimestamp');
            }])
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->query());

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
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

        Supplier::create($validated);

        return redirect()->route('suppliers.index')->with('status', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        if ($supplier->deleteTimestamp) {
            abort(404);
        }

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        if ($supplier->deleteTimestamp) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'businessHours' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:50'],
            'representativeName' => ['nullable', 'string', 'max:255'],
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('status', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->deleteTimestamp) {
            return redirect()->route('suppliers.index');
        }

        $now = now();

        $supplier->update([
            'deleteTimestamp' => $now,
        ]);

        $supplier->foods()
            ->whereNull('deleteTimestamp')
            ->update(['deleteTimestamp' => $now]);

        return redirect()->route('suppliers.index')->with('status', 'Supplier and related foods deleted (soft delete).');
    }
}
