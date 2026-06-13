<?php

namespace App\Filament\Resources\Visimisis;

use App\Filament\Resources\Visimisis\Pages\CreateVisimisi;
use App\Filament\Resources\Visimisis\Pages\EditVisimisi;
use App\Filament\Resources\Visimisis\Pages\ListVisimisis;
use App\Filament\Resources\Visimisis\Pages\ViewVisimisi;
use App\Filament\Resources\Visimisis\Schemas\VisimisiForm;
use App\Filament\Resources\Visimisis\Schemas\VisimisiInfolist;
use App\Filament\Resources\Visimisis\Tables\VisimisisTable;
use App\Models\Visimisi;
use BackedEnum;
use UnitEnum; // ✅ WAJIB
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VisimisiResource extends Resource
{
    protected static ?string $model = Visimisi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // ✅ FIX TERAKHIR
    protected static string|UnitEnum|null $navigationGroup = 'Profil Universitas';

    protected static ?string $navigationLabel = 'Visi & Misi';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'Visimisi';

    public static function form(Schema $schema): Schema
    {
        return VisimisiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VisimisiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisimisisTable::configure($table);
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
            'index' => ListVisimisis::route('/'),
            'create' => CreateVisimisi::route('/create'),
            'view' => ViewVisimisi::route('/{record}'),
            'edit' => EditVisimisi::route('/{record}/edit'),
        ];
    }
}