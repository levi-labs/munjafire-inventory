<?php

namespace App\Http\Controllers;

use App\Models\EoqResult;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function index()
    {
        $title = 'Dashboard Page';
        $products = Product::all();
        $colors = [];

        $count_stock_in = StockIn::count();
        $count_stock_out = StockOut::count();
        $count_product = Product::count();
        $count_user = User::count();

        foreach ($products as $product) {
            // generate warna RGB acak
            $r = rand(100, 255);
            $g = rand(100, 255);
            $b = rand(100, 255);

            // tambahkan transparansi dengan rgba
            $colors[] = "rgba($r, $g, $b, 0.5)"; // 0.5 = opacity
        }
        $stock_in = DB::table('stock_ins')
            ->join('products', 'stock_ins.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('COUNT(stock_ins.id) as total_product'),
                DB::raw('SUM(stock_ins.quantity) as total_quantity')
            )
            ->groupBy('products.name')
            ->get();
        $stock_out = DB::table('stock_outs')
            ->join('products', 'stock_outs.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('COUNT(stock_outs.id) as total_product'),
                DB::raw('SUM(stock_outs.quantity) as total_quantity')
            )
            ->groupBy('products.name')
            ->get();


        return view('pages.dashboard.index', compact(
            'title',
            'products',
            'colors',
            'stock_in',
            'stock_out',
            'count_stock_in',
            'count_stock_out',
            'count_product',
            'count_user'
        ));
    }

    public function changePassword()
    {
        $title = 'Change Password';

        return view('pages.dashboard.change', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $user = User::where('id', Auth('web')->user()->id)->first();
        if (!$user) {
            return back()->with('error', 'user not found');
        }

        if (!Hash::check($old_password, $user->password)) {
            return back()->with('error', 'your old password is incorrect');
        }
        $user->update([
            'password' => bcrypt($new_password)
        ]);

        return back()->with('success', 'password successfully changed');
    }
}
