<?php

namespace App\Filament\Resources\Lectures;

use App\Filament\Resources\Lectures\Pages\CreateLecture;
use App\Filament\Resources\Lectures\Pages\EditLecture;
use App\Filament\Resources\Lectures\Pages\ListLectures;
use App\Filament\Resources\Lectures\Pages\ViewLecture;
use App\Filament\Resources\Lectures\Schemas\LectureForm;
use App\Filament\Resources\Lectures\Schemas\LectureInfolist;
use App\Filament\Resources\Lectures\Tables\LecturesTable;
use App\Models\Lecture;
use BackedEnum;
use UnitEnum; // ✅ WAJIB
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LectureResource extends Resource
{
    protected static ?string $model = Lecture::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // ✅ FIX
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen SDM';

    protected static ?string $navigationLabel = 'Dosen';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'Lecture';

    public static function form(Schema $schema): Schema
    {
        return LectureForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LectureInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LecturesTable::configure($table);
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
            'index' => ListLectures::route('/'),
            'create' => CreateLecture::route('/create'),
            'view' => ViewLecture::route('/{record}'),
            'edit' => EditLecture::route('/{record}/edit'),
        ];
    }
}