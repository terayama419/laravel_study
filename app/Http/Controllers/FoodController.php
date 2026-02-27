<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Food::query()
            ->whereNull('deleteTimestamp')
            ->with(['manufacturer' => function ($q) {
                $q->whereNull('deleteTimestamp');
            }, 'supplier' => function ($q) {
                $q->whereNull('deleteTimestamp');
            }]);

        if ($request->filled('productCode')) {
            $query->where('productCode', 'like', '%' . $request->input('productCode') . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('manufacturerName')) {
            $query->whereHas('manufacturer', function ($q) use ($request) {
                $q->whereNull('deleteTimestamp')
                    ->where('name', 'like', '%' . $request->input('manufacturerName') . '%');
            });
        }

        if ($request->filled('supplierName')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->whereNull('deleteTimestamp')
                    ->where('name', 'like', '%' . $request->input('supplierName') . '%');
            });
        }

        if ($request->filled('expirationDate')) {
            $query->whereDate('expirationDate', $request->input('expirationDate'));
        }

        if ($request->filled('arrivalDate')) {
            $query->whereDate('arrivalDate', $request->input('arrivalDate'));
        }

        if ($request->filled('lotNumber')) {
            $query->where('lotNumber', 'like', '%' . $request->input('lotNumber') . '%');
        }

        if ($request->filled('janCode')) {
            $query->where('janCode', 'like', '%' . $request->input('janCode') . '%');
        }

        if ($request->filled('storageMethod')) {
            $query->where('storageMethod', 'like', '%' . $request->input('storageMethod') . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->input('category') . '%');
        }

        $foods = $query->orderBy('id', 'desc')->paginate(10)->appends($request->query());

        return view('foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manufacturers = Manufacturer::whereNull('deleteTimestamp')->orderBy('name')->get();
        $suppliers = Supplier::whereNull('deleteTimestamp')->orderBy('name')->get();

        return view('foods.create', compact('manufacturers', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'productCode' => ['required', 'string', 'max:255', 'unique:foods,productCode'],
            'name' => ['required', 'string', 'max:255'],
            'manufacturerId' => ['nullable', 'integer', 'exists:manufacturers,id'],
            'supplierId' => ['nullable', 'integer', 'exists:suppliers,id'],
            'purchasePrice' => ['nullable', 'numeric', 'min:0'],
            'sellingPrice' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'expirationDate' => ['nullable', 'date'],
            'arrivalDate' => ['nullable', 'date'],
            'lotNumber' => ['nullable', 'string', 'max:255'],
            'janCode' => ['nullable', 'string', 'max:255'],
            'storageMethod' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'minimumStock' => ['required', 'integer', 'min:0'],
        ]);

        Food::create($validated);

        return redirect()->route('foods.index')->with('status', 'Food created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        if ($food->deleteTimestamp) {
            abort(404);
        }

        $manufacturers = Manufacturer::whereNull('deleteTimestamp')->orderBy('name')->get();
        $suppliers = Supplier::whereNull('deleteTimestamp')->orderBy('name')->get();

        return view('foods.edit', compact('food', 'manufacturers', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'productCode' => ['required', 'string', 'max:255', 'unique:foods,productCode,' . $food->id],
            'name' => ['required', 'string', 'max:255'],
            'manufacturerId' => ['nullable', 'integer', 'exists:manufacturers,id'],
            'supplierId' => ['nullable', 'integer', 'exists:suppliers,id'],
            'purchasePrice' => ['nullable', 'numeric', 'min:0'],
            'sellingPrice' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'expirationDate' => ['nullable', 'date'],
            'arrivalDate' => ['nullable', 'date'],
            'lotNumber' => ['nullable', 'string', 'max:255'],
            'janCode' => ['nullable', 'string', 'max:255'],
            'storageMethod' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'minimumStock' => ['required', 'integer', 'min:0'],
        ]);

        $food->update($validated);

        return redirect()->route('foods.index')->with('status', 'Food updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if ($food->deleteTimestamp) {
            return redirect()->route('foods.index');
        }

        $food->update([
            'deleteTimestamp' => now(),
        ]);

        return redirect()->route('foods.index')->with('status', 'Food deleted successfully.');
    }

    /**
     * Add stock to the specified resource.
     */
    public function addStock(Request $request, Food $food)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $food->addStock($validated['quantity']);

        return redirect()->back()->with('status', 'Stock updated successfully.');
    }
}
