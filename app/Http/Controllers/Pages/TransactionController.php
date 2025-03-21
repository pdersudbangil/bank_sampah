<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\Trash;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('report')->get();
        $reports = Report::all();
        return view('bank_sampah.pages.transaction.index', compact('transactions','reports'));
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
        $request->validate([
            'reports' => 'required',
        ]);

        // Simpan ke database
        Transaction::create([
            'reports' => $request->reports,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $transaction = Transaction::with('report')->where('reports',$id)->get();
        // dd($transaction);
        $trashes = Trash::all();

        return view('bank_sampah.pages.transaction.view', compact('transaction','trashes'));
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
    public function update(Request $request, $id)
    {
        //view transaction
        // dd($request->all());
        try {
            $request->validate([
                'trashes' => 'array',
                'price' => 'array',
                'proces' => 'array',
            ]);
        
            // Ambil transaksi yang ingin diperbarui
            $transactions = Transaction::where('reports', $id)->get();
        
            if ($transactions->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada transaksi ditemukan');
            }
       
        
            // Update setiap transaksi sesuai index
            foreach ($transactions as $index => $transaction) {
                $oldValues = [
                    'trashes' => $transaction->trashes,
                    'price' => $transaction->price,
                    'proces' => $transaction->proces,
                ];
        
                $newValues = [
                    'trashes' => $request->trashes[$index] ?? $transaction->trashes,
                    'price' => $request->price[$index] ?? $transaction->price,
                    'proces' => $request->proces[$index] ?? $transaction->proces,
                ];
        
                // Periksa apakah ada perubahan data
                if ($oldValues !== $newValues) {
                    $transaction->update($newValues);
                }
            }
        
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
        
        //view report
        try {
            $request->validate([
                'trashes' => 'required|array',
                'price' => 'array',
                'total' => 'required|array',
            ]);
    
            // Temukan transaksi berdasarkan ID
            $transaction = Transaction::where('reports',$id)->get();
            // dd($transaction);
    
            // Perbarui satu per satu
            foreach ($transaction as $index => $trashId) {
                $trashId->update([
                    'trashes' => $request->trashes[$index] ?? $transaction->trashes, 
                    'price' => $request->price[$index] ?? null,
                    'total' => $request->total[$index] ?? $transaction->total,
                ]);
            }
            
    
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data berdasarkan ID
            $transaction = Transaction::findOrFail($id);

            // Hapus data
            $transaction->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
