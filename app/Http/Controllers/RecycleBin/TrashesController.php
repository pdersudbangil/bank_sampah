<?php

namespace App\Http\Controllers\RecycleBin;

use App\Http\Controllers\Controller;
use App\Models\Trash;
use App\Models\TypeTrash;
use Illuminate\Http\Request;

class TrashesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashes = Trash::with('typeTrash')->get();
        $typeTrashes = TypeTrash::all();
        return view('bank_sampah.pages.trash.index', compact('trashes', 'typeTrashes'));
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
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'type_of_trash' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);

        // Simpan ke database
        Trash::create([
            'name' => $request->name,
            'type_of_trash' => $request->type_of_trash,
            'price' => $request->price,
            'unit' => $request->unit,
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
        $request->validate([
            'name' => 'required|string|max:255',
            'type_of_trash' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);

        // Cari data berdasarkan ID
        $trash = Trash::findOrFail($id);

        // Update data
        $trash->update([
            'name' => $request->name,
            'type_of_trash' => $request->type_of_trash,
            'price' => $request->price,
            'unit' => $request->unit,
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
            $trash = Trash::findOrFail($id);

            // Hapus data
            $trash->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
