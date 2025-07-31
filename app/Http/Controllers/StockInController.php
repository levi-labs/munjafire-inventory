<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Stock In';
        $stockIns = StockIn::with(['product', 'supplier'])
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($stockIns);

        return view('pages.stock_in.index', compact('title', 'stockIns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Stock In';
        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();
        return view('pages.stock_in.create', compact('title', 'suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);


        try {
            DB::beginTransaction();
            $product_id = Product::findOrFail($request->product_id);
            StockIn::create([
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'description' => $request->description,
            ]);
            $product_id->increment('stock', $request->quantity);
            DB::commit();
            return redirect()->route('stock_in.index')->with('success', 'Stock In created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to create stock in: ' . $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StockIn $stockIn)
    {
        $title = 'Stock In Details';
        $stockIn->load(['product', 'supplier']);
        return view('pages.stock_in.show', compact('title', 'stockIn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockIn $stockIn)
    {
        $title = 'Edit Stock In';
        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();

        return view('pages.stock_in.edit', compact(
            'title',
            'stockIn',
            'suppliers',
            'products'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockIn $stockIn)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($request->product_id);
        $oldQuantity = $stockIn->quantity;
        $tempQuantity = ($product->stock - $oldQuantity) + $request->quantity;

        try {
            DB::beginTransaction();
            $stockIn->update([
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'description' => $request->description,
            ]);
            // Update product stock
            $product->update(['stock' => $tempQuantity]);
            DB::commit();
            return redirect()->route('stock_in.index')->with('success', 'Stock In updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update stock in: ' . $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockIn $stockIn)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($stockIn->product_id);
            $product->decrement('stock', $stockIn->quantity);
            $stockIn->delete();
            DB::commit();
            return redirect()->route('stock_in.index')->with('success', 'Stock In deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to delete stock in: ' . $th->getMessage()]);
        }
    }
}
