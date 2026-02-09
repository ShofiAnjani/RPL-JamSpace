<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudioResource\Pages;
use App\Models\Studio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudioResource extends Resource
{
    protected static ?string $model = Studio::class;

    protected static ?string $navigationLabel = 'Studio';
    protected static ?string $navigationIcon = 'heroicon-o-musical-note';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_studio')
                    ->label('Nama Studio')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('kapasitas')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('harga_per_jam')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_studio')
                    ->label('Studio')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kapasitas')
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_per_jam')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'tersedia',
                        'danger' => 'tidak tersedia',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudios::route('/'),
            'create' => Pages\CreateStudio::route('/create'),
            'edit' => Pages\EditStudio::route('/{record}/edit'),
        ];
    }
}
