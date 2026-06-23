<?php

namespace App\Filament\Resources\News;

use App\Filament\Resources\News\Pages;
use App\Models\News;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Berita';

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Berita';

    protected static string|UnitEnum|null $navigationGroup = 'Publikasi';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255)
                   ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Isi Berita')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Foto Berita')
                    ->image()
                    ->directory('news')
                    ->disk('public')
                    ->required()
                    ->columnSpanFull(),

                Hidden::make('slug'),

                Hidden::make('users_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('content')
                    ->label('Cuplikan')
                    ->formatStateUsing(
                        fn (?string $state): string =>
                        Str::limit(strip_tags($state ?? ''), 60)
                    ),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterbitkan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}