<?php

namespace App\Filament\Resources\Students;

use App\Models\Student;
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
use App\Filament\Resources\Students\Pages\ListStudents;
use App\Filament\Resources\Students\Pages\CreateStudent;
use App\Filament\Resources\Students\Pages\EditStudent;
use BackedEnum;
use UnitEnum;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen SDM';
    protected static ?string $navigationLabel = 'Mahasiswa';
    protected static ?string $modelLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Mahasiswa';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('namalengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Muhammad Rizky Pratama'),

                Forms\Components\TextInput::make('namapanggilan')
                    ->label('Nama Panggilan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Rizky'),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: rizky.pratama@gmail.com'),

                Forms\Components\TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->maxLength(15)
                    ->placeholder('contoh: 081234567890')
                    ->helperText('Maksimal 15 digit, format 08xxxxxxxxxx.'),

                Forms\Components\Select::make('jalur')
                    ->label('Jalur Masuk')
                    ->options([
                        'Reguler'  => 'Reguler',
                        'Beasiswa' => 'Beasiswa',
                        'Transfer' => 'Transfer',
                    ])
                    ->required()
                    ->placeholder('Pilih jalur masuk'),

                Forms\Components\TextInput::make('programstudi_1')
                    ->label('Pilihan Program Studi 1')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: D3 Teknik Komputer'),

                Forms\Components\TextInput::make('programstudi_2')
                    ->label('Pilihan Program Studi 2')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: D3 Sistem Informasi'),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto')
                    ->image()
                    ->directory('students')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Upload pas foto. Format: JPG, PNG. Maks 2MB.')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->height(60)
                    ->circular(),

                TextColumn::make('namalengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('namapanggilan')
                    ->label('Panggilan')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->icon('heroicon-o-envelope'),

                TextColumn::make('nomor_hp')
                    ->label('No. HP')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor HP disalin!')
                    ->icon('heroicon-o-phone'),

                TextColumn::make('jalur')
                    ->label('Jalur Masuk')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Reguler'  => 'info',
                        'Beasiswa' => 'success',
                        'Transfer' => 'warning',
                        default    => 'gray',
                    }),

                TextColumn::make('programstudi_1')
                    ->label('Prodi Pilihan 1')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('programstudi_2')
                    ->label('Prodi Pilihan 2')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Didaftarkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->defaultSort('namalengkap', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudents::route('/'),
            'create' => CreateStudent::route('/create'),
            'edit' => EditStudent::route('/{record}/edit'),
        ];
    }
}