<?php

namespace App\Filament\Resources\Aboutmes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class AboutmesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ✅ tampilkan gambar + perbaikan disk
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public') // penting untuk ambil dari storage
                    ->height(60),     // biar tidak terlalu besar

                // ✅ tanggal dibuat
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),

                // ✅ tanggal update
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}