<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class TotalReservasi extends StatsOverviewWidget
{
    public function getColumnSpan(): int|string|array
    {
        return 1;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Reservasi',
                DB::table('reservasis')->count()
            )
            ->icon('heroicon-o-calendar-days')
            ->color('info'),
        ];
    }
}