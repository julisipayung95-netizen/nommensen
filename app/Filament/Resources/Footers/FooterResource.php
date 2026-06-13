<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages\CreateFooter;
use App\Filament\Resources\Footers\Pages\EditFooter;
use App\Filament\Resources\Footers\Pages\ListFooters;
use App\Filament\Resources\Footers\Pages\ViewFooter;
use App\Filament\Resources\Footers\Schemas\FooterForm;
use App\Filament\Resources\Footers\Schemas\FooterInfolist;
use App\Filament\Resources\Footers\Tables\FootersTable;
use App\Models\Footer;
use BackedEnum;
use UnitEnum; // ✅ TAMBAHKAN INI
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // ✅ FIX DI SINI
    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Footer Website';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'Footer';

    public static function form(Schema $schema): Schema
    {
        return FooterForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FooterInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FootersTable::configure($table);
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
            'index' => ListFooters::route('/'),
            'create' => CreateFooter::route('/create'),
            'view' => ViewFooter::route('/{record}'),
            'edit' => EditFooter::route('/{record}/edit'),
        ];
    }
}