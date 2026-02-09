<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'mulai' => 'required|date',
            'sampai' => 'required|date',
        ]);

        $reservasi = Reservasi::whereBetween('tanggal', [
                $request->mulai,
                $request->sampai
            ])
            ->where('status_reservasi', 'selesai')
            ->get();

        $totalReservasi   = $reservasi->count();
        $totalPendapatan  = $reservasi->sum('total_harga');

        Laporan::create([
            'periode' => $request->mulai . ' s/d ' . $request->sampai,
            'total_reservasi' => $totalReservasi,
            'total_pendapatan' => $totalPendapatan,
        ]);

        return back()->with('success', 'Laporan berhasil dibuat');
    }

    public function cetakPdf($id)
    {
        $laporan = Laporan::findOrFail($id);

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-' . $laporan->id_laporan . '.pdf');
    }
}
