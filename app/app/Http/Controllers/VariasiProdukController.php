<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\VariasiProduk;
use Illuminate\Http\Request;

class VariasiProdukController extends Controller
{
    public function index()
    {
        $variasi = VariasiProduk::with('produk')->get();
        return view('variasi.index', compact('variasi'));
    }

    public function create()
    {
        $produk = Produk::where('status_produk', 'aktif')->get();
        return view('variasi.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'tipe_variasi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        VariasiProduk::create($request->all());
        return redirect()->route('variasi.index')
            ->with('success', 'Variasi produk berhasil ditambahkan.');
    }

    public function edit(VariasiProduk $variasi)
    {
        $produk = Produk::where('status_produk', 'aktif')->get();
        return view('variasi.edit', compact('variasi', 'produk'));
    }

    public function update(Request $request, VariasiProduk $variasi)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'tipe_variasi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        $variasi->update($request->all());
        return redirect()->route('variasi.index')
            ->with('success', 'Variasi produk berhasil diperbarui.');
    }

    public function destroy(VariasiProduk $variasi)
    {
        $variasi->delete();
        return redirect()->route('variasi.index')
            ->with('success', 'Variasi produk berhasil dihapus.');
    }
}
