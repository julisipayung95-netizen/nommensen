<?php

namespace App\Filament\Resources\Cooperations;

use App\Filament\Resources\Cooperations\Pages\CreateCooperation;
use App\Filament\Resources\Cooperations\Pages\EditCooperation;
use App\Filament\Resources\Cooperations\Pages\ListCooperations;
use App\Filament\Resources\Cooperations\Pages\ViewCooperation;
use App\Filament\Resources\Cooperations\Schemas\CooperationInfolist;
use App\Models\Cooperation;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Table;

class CooperationResource extends Resource
{
    protected static string|null $model = Cooperation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Kerja Sama';
    protected static ?string $modelLabel = 'Kerja Sama';
    protected static ?string $pluralModelLabel = 'Kerja Sama';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'Cooperation';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Logo')
                    ->image()
                    ->directory('cooperations')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Upload logo mitra. Format: JPG, PNG. Maks 2MB.')
                    ->columnSpanFull(),
            ]);
    }

    // INFOLIST
    public static function infolist(Schema $schema): Schema
    {
        return CooperationInfolist::configure($schema);
    }

    // TABLE (SUDAH DIPERBAIKI DI SINI)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Logo')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image))
                    ->height(60),

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
            'index'  => ListCooperations::route('/'),
            'create' => CreateCooperation::route('/create'),
            'view'   => ViewCooperation::route('/{record}'),
            'edit'   => EditCooperation::route('/{record}/edit'),
        ];
    }
}