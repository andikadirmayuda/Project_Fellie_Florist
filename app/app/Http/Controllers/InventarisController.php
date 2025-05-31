<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\VariasiProduk;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::with(['variasiProduk.produk', 'user'])->get();
        return view('inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        $variasi = VariasiProduk::with('produk')->get();
        return view('inventaris.create', compact('variasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_variasi' => 'required|exists:variasi_produk,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable'
        ]);

        $data = $request->all();
        $data['id_user'] = auth()->id();
        
        // Update stok di variasi_produk
        $variasi = VariasiProduk::findOrFail($request->id_variasi);
        if ($request->jenis === 'masuk') {
            $variasi->stok += $request->jumlah;
        } else {
            if ($variasi->stok < $request->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }
            $variasi->stok -= $request->jumlah;
        }
        $variasi->save();

        Inventaris::create($data);
        return redirect()->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function show(Inventaris $inventaris)
    {
        return view('inventaris.show', compact('inventaris'));
    }
}
