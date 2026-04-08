<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $items = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name', 'products.image', 'products.price')
            ->where('carts.user_id', Auth::id())
            ->get();

        $total = $items->sum(fn($i) => $i->price * $i->quantity);

        return view('user.cart', compact('items', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $existing = DB::table('carts')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            DB::table('carts')->where('id', $existing->id)
                ->update(['quantity' => $existing->quantity + 1, 'updated_at' => now()]);
        } else {
            DB::table('carts')->insert([
                'user_id'    => Auth::id(),
                'product_id' => $productId,
                'quantity'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function remove($id)
    {
        DB::table('carts')->where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Đã xóa khỏi giỏ hàng!');
    }
}
