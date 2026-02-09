<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Select::make('id_reservasi')
                ->label('Reservasi')
                ->options(
                    Reservasi::query()
                        ->where('status_reservasi', '!=', 'dibayar')
                        ->pluck('id', 'id')
                )
                ->searchable()
                ->required(),

            Forms\Components\Select::make('metode')
                ->options([
                    'cash' => 'Cash',
                    'transfer' => 'Transfer',
                    'qris' => 'QRIS',
                    'ewallet' => 'E-Wallet',
                ])
                ->required(),

            Forms\Components\TextInput::make('jumlah')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('status_pembayaran')
                ->options([
                    'pending' => 'Pending',
                    'dibayar' => 'Dibayar',
                ])
                ->default('pending')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_reservasi')->label('Reservasi'),
                Tables\Columns\TextColumn::make('metode'),
                Tables\Columns\TextColumn::make('jumlah')->money('IDR'),
                Tables\Columns\BadgeColumn::make('status_pembayaran')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'dibayar',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
