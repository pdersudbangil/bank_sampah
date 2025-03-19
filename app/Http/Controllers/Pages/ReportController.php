<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Room;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all()->map(function ($report) {
            $trashes = json_decode($report->trashes, true);
            $total = json_decode($report->total, true);

            // Pastikan hasilnya berupa array
            $report->trashes = is_array($trashes) ? $trashes : [$trashes];
            $report->total = is_array($total) ? $total : [$total];

            return $report;
        });
        $rooms = Room::all();
        return view('bank_sampah.pages.report.index', compact('reports','rooms'));
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
        try {
            // Validasi input
            $request->validate([
                'users' => 'required',
                'rooms' => 'required',
                'trashes' => 'required|array',
                'trashes.*' => 'string|max:255',
            ]);

            // dd($request->all());
    
            // Simpan data satu per satu
            Report::create([
                'users' => $request->users,
                'rooms' => $request->rooms,
                'trashes' => json_encode($request->trashes), // Simpan sebagai JSON
            ]);
    
            return redirect()->back()->with('success', 'Data sampah berhasil disimpan!');
        
        } catch (\Exception $e) {
            // Logging error untuk debugging
            dd($e->getMessage());
            Log::error('Gagal menyimpan data sampah: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Coba lagi!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data berdasarkan ID
        $reports = Report::findOrFail($id);

        // Konversi trashes & total ke array agar bisa di-looping
        $reports->trashes = json_decode($reports->trashes, true) ?? [];
        $reports->total = json_decode($reports->total, true) ?? [];

        // Ambil daftar rooms
        $rooms = Room::all();

        return view('bank_sampah.pages.report.view', compact('reports', 'rooms'));
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
        try{
            // Validasi Input
            $request->validate([
                'trashes' => 'required|array',
                'trashes.*' => 'string', // Setiap item dalam array trashes harus string
                'total' => 'required|array',
                'total.*' => 'numeric', // Setiap item dalam array total harus angka
                'rooms' => 'required|exists:rooms,id',
            ]);

            // Cari data yang akan diupdate
            $report = Report::findOrFail($id);

            // Update data
            $report->trashes = json_encode($request->trashes); // Simpan sebagai JSON
            $report->total = json_encode($request->total); // Simpan sebagai JSON
            $report->rooms = $request->rooms;
            
            $report->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->route('report.show', $id)->with('success', 'Data berhasil diperbarui!');
        } catch (QueryException $e) {
            // Tangkap error dari database
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan ke database: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangkap error umum lainnya
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data berdasarkan ID
            $reports = Report::findOrFail($id);

            // Hapus data
            $reports->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
