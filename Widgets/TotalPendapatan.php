<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class TotalPendapatan extends StatsOverviewWidget
{
    public function getColumnSpan(): int|string|array
    {
        return 1;
    }

    protected function getStats(): array
    {
        $totalPendapatan = DB::table('pembayarans')
            ->where('status_pembayaran', 'dibayar')
            ->sum('jumlah');

        return [
            Stat::make(
                'Total Pendapatan',
                'Rp ' . number_format($totalPendapatan, 0, ',', '.')
            )
            ->icon('heroicon-o-banknotes')
            ->color('success'),
        ];
    }
}