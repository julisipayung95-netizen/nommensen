<?php

namespace App\Filament\Resources\Announcements;

use App\Filament\Resources\Announcements\Pages;
use App\Models\Announcement;
use BackedEnum;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Pengumuman';

    protected static ?string $modelLabel = 'Pengumuman';

    protected static ?string $pluralModelLabel = 'Pengumuman';

    protected static string|UnitEnum|null $navigationGroup = 'Publikasi';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Pengumuman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Jadwal UAS Semester Ganjil 2025/2026')
                    ->helperText('Slug URL akan dibuat otomatis dari judul ini.')
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Isi Pengumuman')
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('content')
                    ->label('Cuplikan')
                    ->formatStateUsing(
                        fn (?string $state): string =>
                        Str::limit(strip_tags($state ?? ''), 60)
                    )
                    ->wrap(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Dibuat Oleh')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterbitkan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->toolbarActions([
                \Filament\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}