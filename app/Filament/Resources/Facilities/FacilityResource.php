<?php

namespace App\Filament\Resources\Facilities;

use App\Filament\Resources\Facilities\Pages\CreateFacility;
use App\Filament\Resources\Facilities\Pages\EditFacility;
use App\Filament\Resources\Facilities\Pages\ListFacilities;
use App\Filament\Resources\Facilities\Pages\ViewFacility;
use App\Models\Facility;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class FacilityResource extends Resource
{
    // MODEL
    protected static string|null $model = Facility::class;

    // ICON (dari kamu, sudah diperbaiki type)
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-library';

    // LABEL
    protected static ?string $navigationLabel = 'Fasilitas';
    protected static ?string $modelLabel = 'Fasilitas';
    protected static ?string $pluralModelLabel = 'Fasilitas';

    // GROUP & SORT (FIX)
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 3;

    // TITLE
    protected static ?string $recordTitleAttribute = 'Facility';

    // FORM (contoh umum fasilitas)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('content')
                ->label('Deskripsi Fasilitas')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h3',
                    'h4',
                ])
                ->required()
                ->helperText('Jelaskan fasilitas kampus secara detail.')
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Foto Fasilitas')
                ->image()
                ->directory('facilities')
                ->disk('public')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(3072)
                ->required()
                ->helperText('Upload foto fasilitas. Format: JPG, PNG. Maks 3MB.')
                ->columnSpanFull(),
        ]);
    }

    // INFOLIST
    public static function infolist(Schema $schema): Schema
    {
        return $schema;
    }

    // TABLE (sementara aman kosong)
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image')
                ->label('Logo')
                ->getStateUsing(fn ($record) => asset('storage/' . $record->image))
                ->height(60),

            TextColumn::make('content')
            ->label('Deskripsi')
            ->formatStateUsing(fn ($state) => 
                Str::limit(strip_tags($state ?? ''), 100)
            )
            ->wrap(),

            TextColumn::make('created_at')
            ->label('Ditambahkan')
            ->dateTime('d M Y H:i')
            ->sortable(),

            TextColumn::make('updated_at')
            ->label('Diperbarui')
            ->dateTime('d M Y H:i')
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),
    ])
    ->filters([
        //
    ])
    ->actions([
        EditAction::make(),
        DeleteAction::make(),
    ])
    ->bulkActions([
        BulkActionGroup::make([
            DeleteBulkAction::make(),
        ]),
    ])
    ->defaultSort('created_at', 'desc');
}
    

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListFacilities::route('/'),
            'create' => CreateFacility::route('/create'),
            'view'   => ViewFacility::route('/{record}'),
            'edit'   => EditFacility::route('/{record}/edit'),
        ];
    }
}