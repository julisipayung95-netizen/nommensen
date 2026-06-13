<?php

namespace App\Filament\Resources\Footers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FooterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('link_instagram')
                    ->required(),
                TextInput::make('link_youtube')
                    ->required(),
                TextInput::make('link_linkedin')
                    ->required(),
                TextInput::make('link_facebook')
                    ->required(),
                TextInput::make('alamat')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('wa')
                    ->required(),
                TextInput::make('link_gmaps')
                    ->required(),
            ]);
    }
}
