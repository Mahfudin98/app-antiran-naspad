<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'gambar' => 'required',
        ]);
        $data = Product::create($request->all());
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('product/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Ditambah!');
    }

    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'gambar' => 'required',
        ]);
        $data = Product::find($id);
        $data->update($request->all());
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('product/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Diupdate!');
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
        } finally {
            DB::commit();
            return redirect()->back()->with('success', 'Produk Berhasil Dihapus!');
        }
    }
}
