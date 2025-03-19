<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\TypeTrash;
use Illuminate\Http\Request;

class TypeTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $TypeTrashes = TypeTrash::all();
        return view('bank_sampah.pages.type.index', compact('TypeTrashes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'type_of_trash' => 'required|string|max:255',
        ]);

        // Simpan ke database
        TypeTrash::create([
            'type_of_trash' => $request->type_of_trash,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'type_of_trash' => 'required|string|max:255',
        ]);

        // Cari data berdasarkan ID
        $trash = TypeTrash::findOrFail($id);

        // Update data
        $trash->update([
            'type_of_trash' => $request->type_of_trash,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data berdasarkan ID
            $trash = TypeTrash::findOrFail($id);

            // Hapus data
            $trash->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
