<?php

namespace App\Filament\Resources\AdminResource\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    /**
     * Jumlah kolom dashboard
     */
    public function getColumns(): int|array
    {
        return 3;
    }

    /**
     * HILANGIN "Welcome admin" & "filament v3"
     */
    protected function getHeaderWidgets(): array
    {
        return [];
    }
}