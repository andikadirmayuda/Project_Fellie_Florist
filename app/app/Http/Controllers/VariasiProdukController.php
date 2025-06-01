<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\VariasiProduk;
use Illuminate\Http\Request;

class VariasiProdukController extends Controller
{    public function index(Request $request)
    {
        $query = VariasiProduk::with(['produk.kategori']);

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->whereHas('produk', function($q) use ($request) {
                $q->where('id_kategori', $request->kategori_id);
            });
        }

        // Filter by tipe variasi
        if ($request->filled('tipe_variasi')) {
            $query->where('tipe_variasi', $request->tipe_variasi);
        }

        // Filter by nama produk
        if ($request->filled('search')) {
            $query->whereHas('produk', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%');
            });
        }

        $variasiProduk = $query->get();
        $kategori = \App\Models\Kategori::all();
        $tipeVariasi = ['pertangkai', 'perikat(5)', 'perikat(10)', 'perikat(20)', 'normal', 'reseller', 'promo'];

        return view('variasi.index', compact('variasiProduk', 'kategori', 'tipeVariasi'));
    }

    public function create()
    {
        $produk = Produk::where('status_produk', 'aktif')->get();
        return view('variasi.create', compact('produk'));
    }    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'tipe_variasi' => 'required|in:pertangkai,perikat(5),perikat(10),perikat(20),normal,reseller,promo',
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
    }    public function update(Request $request, VariasiProduk $variasi)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'tipe_variasi' => 'required|in:pertangkai,perikat(5),perikat(10),perikat(20),normal,reseller,promo',
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
