<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StudioTerlaris extends StatsOverviewWidget
{
    public function getColumnSpan(): int|string|array
    {
        return 1;
    }

    protected function getStats(): array
    {
        $jumlah = DB::table('reservasis')
            ->select('studio_id', DB::raw('COUNT(*) as total'))
            ->groupBy('studio_id')
            ->orderByDesc('total')
            ->value('total') ?? 0;

        return [
            Stat::make('Studio Terlaris', $jumlah)
                ->icon('heroicon-o-building-storefront')
                ->color('warning'),
        ];
    }
}