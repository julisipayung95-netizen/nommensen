<?php

namespace App\Filament\Resources\Aboutmes;

use App\Filament\Resources\Aboutmes\Pages\CreateAboutme;
use App\Filament\Resources\Aboutmes\Pages\EditAboutme;
use App\Filament\Resources\Aboutmes\Pages\ListAboutmes;
use App\Filament\Resources\Aboutmes\Pages\ViewAboutme;
use App\Filament\Resources\Aboutmes\Schemas\AboutmeForm;
use App\Filament\Resources\Aboutmes\Schemas\AboutmeInfolist;
use App\Filament\Resources\Aboutmes\Tables\AboutmesTable;
use App\Models\Aboutme;
use BackedEnum;
use UnitEnum; // ✅ TAMBAHKAN INI
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutmeResource extends Resource
{
    protected static ?string $model = Aboutme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // ✅ FIX DI SINI
    protected static string|UnitEnum|null $navigationGroup = 'Profil Universitas';

    protected static ?string $navigationLabel = 'Profil Universitas';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'Aboutme';

    public static function form(Schema $schema): Schema
    {
        return AboutmeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AboutmeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutmesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutmes::route('/'),
            'create' => CreateAboutme::route('/create'),
            'view' => ViewAboutme::route('/{record}'),
            'edit' => EditAboutme::route('/{record}/edit'),
        ];
    }
}