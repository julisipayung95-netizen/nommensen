<?php

namespace App\Filament\Resources\Rektors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RektorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('jabatan')
                    ->required(),
                Textarea::make('image')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
