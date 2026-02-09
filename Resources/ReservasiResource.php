<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservasiResource\Pages;
use App\Models\Reservasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;

    protected static ?string $navigationLabel = 'Reservasi';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /** ===============================
                 *  RELASI STUDIO (WAJIB ADA)
                 *  =============================== */
                Forms\Components\Select::make('studio_id')
                    ->label('Studio')
                    ->relationship('studio', 'nama_studio')
                    ->searchable()
                    ->preload() // ⬅️ biar dropdown pasti muncul
                    ->required(),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),

                Forms\Components\TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->seconds(false)
                    ->required(),

                Forms\Components\TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->seconds(false)
                    ->required(),

                Forms\Components\Select::make('status_reservasi')
                    ->label('Status')
                    ->options([
                        'dibuat' => 'Dibuat',
                        'dikonfirmasi' => 'Dikonfirmasi',
                        'dibayar' => 'Dibayar',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->default('dibuat') // ⬅️ biar ga null
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('studio.nama_studio')
                    ->label('Studio')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Mulai'),

                Tables\Columns\TextColumn::make('jam_selesai')
                    ->label('Selesai'),

                Tables\Columns\TextColumn::make('status_reservasi')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'dibuat',
                        'info' => 'dikonfirmasi',
                        'success' => 'dibayar',
                        'secondary' => 'selesai',
                        'danger' => 'dibatalkan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('tanggal', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListReservasis::route('/'),
            'create' => Pages\CreateReservasi::route('/create'),
            'edit'   => Pages\EditReservasi::route('/{record}/edit'),
        ];
    }
}
