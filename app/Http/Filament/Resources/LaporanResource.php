<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Models\Laporan;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationGroup = 'Laporan & Keuangan';
    protected static ?int $navigationSort = 4;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('periode')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('total_reservasi')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('total_pendapatan')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('periode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_reservasi')
                    ->label('Total Reservasi')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_pendapatan')
                    ->label('Total Pendapatan')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('cetak')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Laporan $record) => route('laporan.cetak', $record->id_laporan))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('generateBulanan')
                ->label('Generate Laporan Bulan Ini')
                ->icon('heroicon-o-arrow-path')
                ->color('success')
                ->url(route('laporan.generate.bulanan'))
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }
}
