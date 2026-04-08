<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.id', 'desc');

        if ($request->filled('search')) {
            $query->where('products.name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = DB::table('categories')->orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:10240',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid()) {
                return back()->withErrors(['image' => 'File ảnh bị lỗi khi upload, vui lòng thử lại.'])->withInput();
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->insert([
            'name'        => $request->name,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product    = DB::table('products')->where('id', $id)->first();
        abort_if(!$product, 404);
        $categories = DB::table('categories')->orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:10240',
        ]);

        $product = DB::table('products')->where('id', $id)->first();
        abort_if(!$product, 404);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid()) {
                return back()->withErrors(['image' => 'File ảnh bị lỗi khi upload, vui lòng thử lại.'])->withInput();
            }
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->where('id', $id)->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
            'updated_at'  => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if ($product && $product->image) {
            Storage::disk('public')->delete($product->image);
        }
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
