<?php

namespace App\Filament\Resources\Greetings;

use App\Filament\Resources\Greetings\Pages\CreateGreeting;
use App\Filament\Resources\Greetings\Pages\EditGreeting;
use App\Filament\Resources\Greetings\Pages\ListGreetings;
use App\Filament\Resources\Greetings\Pages\ViewGreeting;
use App\Models\Greeting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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

class GreetingResource extends Resource
{
    // MODEL
    protected static string|null $model = Greeting::class;

    // ICON (dari kamu, sudah diperbaiki tipenya)
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    // LABEL (sesuai kamu)
    protected static ?string $navigationLabel = 'Sambutan';
    protected static ?string $modelLabel = 'Sambutan';
    protected static ?string $pluralModelLabel = 'Sambutan';

    // GROUP & SORT (FIX)
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 2;

    // TITLE
    protected static ?string $recordTitleAttribute = 'Greeting';

    // FORM (contoh umum untuk sambutan)
    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            RichEditor::make('content')
                ->label('Isi Sambutan')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h2',
                    'h3',
                    'blockquote',
                    'redo',
                    'undo',
                ])
                ->required()
                ->helperText('Tulis isi sambutan pimpinan universitas.')
                ->columnSpanFull(),
            FileUpload::make('image')
                ->label('Foto Pimpinan')
                ->image()
                ->directory('greetings')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(2048)
                ->required()
                ->helperText('Upload foto pimpinan. Format: JPG, PNG. Maks 2MB.')
                ->columnSpanFull(),

        ]);
    }

    // INFOLIST
    public static function infolist(Schema $schema): Schema
    {
        return $schema;
    }

    // TABLE
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image')
                    ->label('Logo')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image))
                    ->height(60),

            TextColumn::make('content')
                ->label('Cuplikan Sambutan')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 80))
                ->wrap(),

            TextColumn::make('created_at')
                ->label('Ditambahkan')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(),

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
            'index'  => ListGreetings::route('/'),
            'create' => CreateGreeting::route('/create'),
            'view'   => ViewGreeting::route('/{record}'),
            'edit'   => EditGreeting::route('/{record}/edit'),
        ];
    }
}