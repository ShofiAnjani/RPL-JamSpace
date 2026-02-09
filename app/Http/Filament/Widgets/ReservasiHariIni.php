<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ReservasiHariIni extends StatsOverviewWidget
{
    public function getColumnSpan(): int|array
    {
        return 1;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Reservasi Hari Ini',
                DB::table('reservasis')
                    ->whereDate('tanggal', now()->toDateString())
                    ->count()
            )
            ->icon('heroicon-o-clock')
            ->color('primary'),
        ];
    }
}