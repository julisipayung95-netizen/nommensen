<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages\CreateFooter;
use App\Filament\Resources\Footers\Pages\EditFooter;
use App\Filament\Resources\Footers\Pages\ListFooters;
use App\Filament\Resources\Footers\Pages\ViewFooter;
use App\Filament\Resources\Footers\Schemas\FooterInfolist;
use App\Models\Footer;
use BackedEnum;
use UnitEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | UnitEnum | null $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Pengaturan Footer';
    protected static ?string $modelLabel = 'Footer';
    protected static ?string $pluralModelLabel = 'Pengaturan Footer';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas & Lokasi')
                    ->description('Logo, alamat, dan peta lokasi yang ditampilkan di footer website.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Logo Universitas')
                            ->image()
                            ->directory('footers')
                            ->visibility('public')
                            ->imagePreviewHeight('120')
                            ->maxSize(2048)
                            ->required()
                            ->helperText('Logo putih/transparan paling cocok untuk footer.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: Jl. Pendidikan No. 1, Pematangsiantar, Sumatera Utara 21121')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('link_gmaps')
                            ->label('Link Google Maps (Embed URL)')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                            ->helperText('Buka Google Maps → cari lokasi → Share → Embed a map → copy URL src.')
                            ->columnSpanFull(),
                    ]),
                Section::make('Kontak Resmi')
                    ->description('Email dan nomor WhatsApp yang bisa dihubungi pengunjung website.')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email Kontak')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->prefix('@')
                            ->placeholder('contoh: info@b-university.ac.id'),
                        Forms\Components\TextInput::make('wa')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->maxLength(255)
                            ->prefix('+62')
                            ->placeholder('contoh: 81234567890')
                            ->helperText('Tulis tanpa angka 0 di depan dan tanpa +62 (sudah di-prefix).'),
                    ])
                    ->columns(2),
                Section::make('Sosial Media')
                    ->description('Link akun resmi universitas di berbagai platform sosial media.')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\TextInput::make('link_instagram')
                            ->label('Instagram')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://instagram.com/buniversity'),
                        Forms\Components\TextInput::make('link_youtube')
                            ->label('YouTube')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://youtube.com/@buniversity'),
                        Forms\Components\TextInput::make('link_linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://linkedin.com/school/buniversity'),
                        Forms\Components\TextInput::make('link_facebook')
                            ->label('Facebook')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://facebook.com/buniversity'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FooterInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Logo')
                    ->disk('public')
                    ->height(50),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->tooltip(fn (?string $state): ?string => $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->icon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('wa')
                    ->label('WhatsApp')
                    ->copyable()
                    ->copyMessage('Nomor WA disalin!')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->prefix('+62 '),
                Tables\Columns\TextColumn::make('link_instagram')
                    ->label('Instagram')
                    ->url(fn ($record) => $record->link_instagram, true)
                    ->icon('heroicon-o-link')
                    ->formatStateUsing(fn (?string $state): string => $state ? 'Buka' : '-')
                    ->color('info'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFooters::route('/'),
            'create' => CreateFooter::route('/create'),
            'view' => ViewFooter::route('/{record}'),
            'edit' => EditFooter::route('/{record}/edit'),
        ];
    }
}