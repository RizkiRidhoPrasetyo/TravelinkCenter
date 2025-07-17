<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TravelinkPackageResource\Pages;
use App\Filament\Resources\TravelinkPackageResource\RelationManagers;
use App\Models\TravelinkPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TravelinkPackageResource extends Resource
{
    protected static ?string $model = TravelinkPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Tempat Wisata')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('region')
                    ->label('Daerah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Wisata')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Harga Tempat Wisata')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('promo_price')
                    ->label('Harga Promo')
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('hashtag')
                    ->label('Hashtag Kategori Wisata')
                    ->maxLength(255),
                Forms\Components\TextInput::make('max_quota')
                    ->label('Jumlah Kuota Maksimal')
                    ->required()
                    ->numeric(),
                Forms\Components\FileUpload::make('images')
                    ->label('Gambar')
                    ->multiple()
                    ->maxFiles(4)
                    ->image()
                    ->directory('assets/images') // Lokasi penyimpanan baru
                    ->disk('public') // Gunakan disk 'public'
                    ->required()
                    ->acceptedFileTypes(['image/png', 'image/jpeg'])
                    ->preserveFilenames()
                    ->enableReordering(),
                Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Top Destination' => 'Top Destination',
                        'Top Deals' => 'Top Deals',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('expired_at')
                    ->label('Tanggal Kadaluarsa')
                    ->required()
                    ->displayFormat('Y-m-d')
                    ->default(now()->addDays(30)->format('Y-m-d')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Tempat Wisata')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->label('Daerah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi Wisata')
                    ->limit(50),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga Tempat Wisata')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('promo_price')
                    ->label('Harga Promo')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('hashtag')
                    ->label('Hashtag Kategori Wisata')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_quota')
                    ->label('Jumlah Kuota Maksimal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('images')
                    ->label('Gambar')
                    ->size(50)
                    ->getStateUsing(fn ($record) => collect($record->images)->map(fn ($image) => asset('storage/' . $image))->toArray()),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label('Tanggal Kadaluarsa')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTravelinkPackages::route('/'),
            'create' => Pages\CreateTravelinkPackage::route('/create'),
            'edit' => Pages\EditTravelinkPackage::route('/{record}/edit'),
        ];
    }
}
