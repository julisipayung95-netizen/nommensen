<?php

namespace App\Filament\Resources\Lectures\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LectureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama'),
                TextEntry::make('nidn'),
                TextEntry::make('pendidikan'),
                TextEntry::make('jabatan'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('topik'),
                ImageEntry::make('image')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
