<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{    public function index(Request $request)
    {
        $query = Produk::with('kategori')->withCount('variasi');
          if ($request->has('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search !== '') {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
        $categories = Kategori::all();

        return view('produk.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('produk.create', compact('categories'));
    }    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:produk',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'status_produk' => 'required|in:aktif,tidak_aktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $validated['gambar'] = $path;
        }
        
        // Map kategori_id to id_kategori
        $validated['id_kategori'] = $validated['kategori_id'];
        unset($validated['kategori_id']);
        
        // Add dibuat_oleh
        $validated['dibuat_oleh'] = auth()->user()->name;

        Produk::create($validated);return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $categories = Kategori::all();
        return view('produk.edit', compact('produk', 'categories'));
    }    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:produk,kode_produk,'.$produk->id,
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'status_produk' => 'required|in:aktif,tidak_aktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $path = $request->file('gambar')->store('products', 'public');
            $validated['gambar'] = $path;
        }

        // Map kategori_id to id_kategori
        $validated['id_kategori'] = $validated['kategori_id'];
        unset($validated['kategori_id']);
        
        $produk->update($validated);return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {        if ($produk->variasi()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus produk yang memiliki variasi.');
        }

        // Delete image if exists
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    // Role-specific views
    public function kasirIndex()
    {
        $products = Produk::with('kategori')->paginate(10);
        return view('produk.kasir.index', compact('products'));
    }

    public function karyawanIndex()
    {
        $products = Produk::with('kategori')->paginate(10);
        return view('produk.karyawan.index', compact('products'));
    }

    public function pelangganIndex()
    {
        $products = Produk::with('kategori')->paginate(10);
        return view('produk.pelanggan.index', compact('products'));
    }
}
