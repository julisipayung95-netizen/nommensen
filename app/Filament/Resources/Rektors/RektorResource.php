<?php

namespace App\Filament\Resources\Rektors;

use App\Filament\Resources\Rektors\Pages\CreateRektor;
use App\Filament\Resources\Rektors\Pages\EditRektor;
use App\Filament\Resources\Rektors\Pages\ListRektors;
use App\Filament\Resources\Rektors\Pages\ViewRektor;
use App\Filament\Resources\Rektors\Schemas\RektorForm;
use App\Filament\Resources\Rektors\Schemas\RektorInfolist;
use App\Filament\Resources\Rektors\Tables\RektorsTable;
use App\Models\Rektor;
use BackedEnum;
use UnitEnum; // ✅ WAJIB
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RektorResource extends Resource
{
    protected static ?string $model = Rektor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // ✅ FIX
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen SDM';

    protected static ?string $navigationLabel = 'Pimpinan / Rektor';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'Rektor';

    public static function form(Schema $schema): Schema
    {
        return RektorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RektorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RektorsTable::configure($table);
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
            'index' => ListRektors::route('/'),
            'create' => CreateRektor::route('/create'),
            'view' => ViewRektor::route('/{record}'),
            'edit' => EditRektor::route('/{record}/edit'),
        ];
    }
}