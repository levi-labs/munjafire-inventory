<?php

namespace App\Http\Controllers;

use App\Models\EoqResult;
use App\Models\Product;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Stock Out';
        $stockOuts = StockOut::with(['product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.stock_out.index', compact('title', 'stockOuts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Stock Out';
        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();
        return view('pages.stock_out.create', compact('title', 'suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        $product_id = Product::findOrFail($request->product_id);
        if ($product_id->stock < $request->quantity) {
            return back()->with('info', 'Stock out failed, stock quantity is not enough');
        }
        try {
            DB::beginTransaction();

            StockOut::create([
                'product_id' => $request->product_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'description' => $request->description,
            ]);

            $product_id->decrement('stock', $request->quantity);
            DB::commit();
            return redirect()->route('stock_out.index')->with('success', 'Stock Out created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StockOut $stockOut)
    {
        $title = 'Stock Out Details';
        $stockOut->load(['product']);
        return view('pages.stock_out.show', compact('title', 'stockOut'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOut $stockOut)
    {
        $title = 'Edit Stock Out';
        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();
        return view('pages.stock_out.edit', compact('title', 'stockOut', 'suppliers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockOut $stockOut)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        $product_id     = Product::findOrFail($request->product_id);
        $oldQuantity    = $stockOut->quantity;
        $current_stock  = $product_id->stock + $oldQuantity;
        $tempQuantity   = ($product_id->stock + $oldQuantity) - $request->quantity;
        if ($current_stock < $request->quantity) {
            return back()->with('success', 'Stock out failed stock quantity is not enough');
        }
        try {
            DB::beginTransaction();
            $stockOut->update([
                'product_id' => $request->product_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'description' => $request->description,
            ]);
            $eoq_result = EoqResult::where('product_id', $product_id->id)->first();
            if ($eoq_result) {
                Notification::create([
                    'type' => 'info',
                    'title' => 'safety stock',
                    'message' => 'Some products have reached or fallen below their safety stock levels',
                    'user_id' => Auth('web')->user()->id,
                    'to_head' => 1,
                    'to_admin' => 1
                ]);
            }
            $product_id->update(['stock' => $tempQuantity]);
            DB::commit();
            return redirect()->route('stock_out.index')->with('success', 'Stock Out updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockOut $stockOut)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($stockOut->product_id);
            $product->increment('stock', $stockOut->quantity);
            $stockOut->delete();
            DB::commit();
            return redirect()->route('stock_out.index')->with('success', 'Stock Out deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function eoq()
    // {
    //     $title = 'EOQ Settings';
    //     $datas = getEoq(1); // Assuming product ID 1 for demonstration
    //     if (!$datas) {
    //         return view('pages.eoq_result.index','datas')
    //     }
    // }
}
