<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori')->withCount('variations');
        
        if ($request->has('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
        $categories = Kategori::all();

        return view('produk.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $validated['gambar'] = $path;
        }

        Produk::create($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Produk $produk)
    {
        $categories = Kategori::all();
        return view('produk.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori,id',
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

        $produk->update($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->variations()->count() > 0) {
            return back()->with('error', 'Cannot delete product that has variations.');
        }

        // Delete image if exists
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Product deleted successfully.');
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
