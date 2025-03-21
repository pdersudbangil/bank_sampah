<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Trash;
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
        $trashes = Trash::all();
        return view('bank_sampah.pages.report.index', compact('reports','rooms','trashes'));
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
            $request->validate([
                'trashes' => 'required|array',
                'rooms' => 'required',
                'users' => 'required',
            ]);
        
            // $total = '';
            // Simpan satu per satu
            foreach ($request->trashes as $trashId) {
                // $total += $trashId;
                $data[] = [
                    'trashes' => $trashId,  // Sama untuk semua sampah
                ];
            }

            $data_header = [
                'total' => count($request->trashes),
                'rooms' => $request->rooms,
                'users' => $request->users,
            ];

            // dd($data);
            $insert_header = Report::create($data_header);

            foreach($data as $item){
                $item['reports'] = $insert_header->id;
                $insert_item = Transaction::create($item);
            }
        
            return redirect()->back()->with('success', 'Data sampah berhasil disimpan!');
        
        } catch (\Exception $e) {
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
        $transactions = Transaction::all()->where('reports', $id);
        // dd($transactions);

        // Ambil daftar rooms
        $rooms = Room::all();

        return view('bank_sampah.pages.report.view', compact('transactions', 'rooms'));
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
            return redirect()->route('report.index')->with('success', 'Data berhasil diperbarui!');
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
