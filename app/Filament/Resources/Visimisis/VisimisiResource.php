<?php

namespace App\Filament\Resources\Visimisis;

use App\Models\Visimisi;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Visimisis\Pages\ListVisimisis;
use App\Filament\Resources\Visimisis\Pages\CreateVisimisi;
use App\Filament\Resources\Visimisis\Pages\EditVisimisi;
use Illuminate\Support\Str;
use BackedEnum;
use UnitEnum;

class VisimisiResource extends Resource
{
    protected static ?string $model = Visimisi::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-eye';
    protected static string | UnitEnum | null $navigationGroup = 'Profil Universitas';
    protected static ?string $navigationLabel = 'Visi & Misi';
    protected static ?string $modelLabel = 'Visi & Misi';
    protected static ?string $pluralModelLabel = 'Visi & Misi';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\RichEditor::make('visi')
                    ->label('Visi')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'link',
                        'h3',
                    ])
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('misi')
                    ->label('Misi')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'link',
                        'h3',
                    ])
                    ->required()
                    ->helperText('Gunakan numbered list untuk menuliskan poin-poin misi.')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto (Multiple)')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(5)
                    ->directory('visimisis')
                    ->visibility('public')
                    ->imagePreviewHeight('120')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Bisa upload beberapa foto. Maks 5 foto, masing-masing 2MB.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->height(50)
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),

                TextColumn::make('visi')
                    ->label('Visi')
                    ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                    ->wrap()
                    ->searchable(),

                TextColumn::make('misi')
                    ->label('Misi')
                    ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                    ->wrap()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVisimisis::route('/'),
            'create' => CreateVisimisi::route('/create'),
            'edit' => EditVisimisi::route('/{record}/edit'),
        ];
    }
}