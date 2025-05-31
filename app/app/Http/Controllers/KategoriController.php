<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{    public function index()
    {
        $categories = Kategori::withCount('produk')->paginate(10);
        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:255|unique:kategori',
            'nama_kategori' => 'required|string|max:255'
        ], [
            'kode_kategori.required' => 'Kode kategori harus diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan.',
            'kode_kategori.max' => 'Kode kategori tidak boleh lebih dari 255 karakter.',
            'nama_kategori.required' => 'Nama kategori harus diisi.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.'
        ]);

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:255|unique:kategori,kode_kategori,' . $kategori->id,
            'nama_kategori' => 'required|string|max:255'
        ], [
            'kode_kategori.required' => 'Kode kategori harus diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan.',
            'kode_kategori.max' => 'Kode kategori tidak boleh lebih dari 255 karakter.',
            'nama_kategori.required' => 'Nama kategori harus diisi.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.'
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->produk()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus kategori yang memiliki produk.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
