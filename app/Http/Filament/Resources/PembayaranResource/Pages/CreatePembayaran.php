<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->status_pembayaran === 'dibayar') {
            $this->record->reservasi()->update([
                'status_reservasi' => 'dibayar',
            ]);
        }
    }
}
