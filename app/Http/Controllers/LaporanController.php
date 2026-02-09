<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Reservasi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function generateBulanan()
    {
        $bulan = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('Y');

        $periode = Carbon::now()->translatedFormat('F Y'); // contoh: Februari 2026

        // CEGAH DUPLIKASI
        $cek = Laporan::where('periode', $periode)->first();
        if ($cek) {
            return back()->with('warning', 'Laporan bulan ini sudah ada.');
        }

        $totalReservasi = Reservasi::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->whereIn('status_reservasi', ['dibayar', 'selesai'])
            ->count();

        $totalPendapatan = Reservasi::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->whereIn('status_reservasi', ['dibayar', 'selesai'])
            ->sum('total_harga');

        Laporan::create([
            'periode' => $periode,
            'total_reservasi' => $totalReservasi,
            'total_pendapatan' => $totalPendapatan,
        ]);

        return back()->with('success', 'Laporan bulanan berhasil dibuat.');
    }
}
