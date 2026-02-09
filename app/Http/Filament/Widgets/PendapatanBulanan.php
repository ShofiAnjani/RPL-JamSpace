<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class PendapatanBulanIni extends StatsOverviewWidget
{
    public function getColumnSpan(): int|array
    {
        return 1;
    }

    protected function getStats(): array
    {
        $pendapatan = DB::table('pembayarans')
            ->where('status_pembayaran', 'dibayar')
            ->whereMonth('created_at', now()->month)
            ->sum('jumlah');

        return [
            Stat::make(
                'Pendapatan Bulan Ini',
                'Rp ' . number_format($pendapatan, 0, ',', '.')
            )
            ->icon('heroicon-o-currency-dollar')
            ->color('success'),
        ];
    }
}