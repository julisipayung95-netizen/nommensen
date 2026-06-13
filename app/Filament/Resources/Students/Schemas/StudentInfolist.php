<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('namalengkap'),
                TextEntry::make('namapanggilan'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('nomor_hp'),
                TextEntry::make('jalur'),
                ImageEntry::make('image')
                    ->columnSpanFull(),
                TextEntry::make('programstudi_1'),
                TextEntry::make('programstudi_2'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
