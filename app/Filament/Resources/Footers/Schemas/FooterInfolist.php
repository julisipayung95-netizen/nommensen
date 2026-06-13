<?php

namespace App\Filament\Resources\Footers\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FooterInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image'),
                TextEntry::make('link_instagram'),
                TextEntry::make('link_youtube'),
                TextEntry::make('link_linkedin'),
                TextEntry::make('link_facebook'),
                TextEntry::make('alamat'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('wa'),
                TextEntry::make('link_gmaps'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
