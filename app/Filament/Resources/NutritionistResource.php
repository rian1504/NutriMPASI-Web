<?php

namespace App\Filament\Resources;

use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Nutritionist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NutritionistResource\Pages;
use App\Filament\Resources\NutritionistResource\RelationManagers;
use App\Filament\Resources\NutritionistResource\Pages\EditNutritionist;
use App\Filament\Resources\NutritionistResource\Pages\ListNutritionists;
use App\Filament\Resources\NutritionistResource\Pages\CreateNutritionist;
use Filament\Forms\Components\Select;

class NutritionistResource extends Resource
{
    protected static ?string $model = Nutritionist::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Ahli Gizi';

    protected static ?string $slug = 'nutritionists';

    protected static ?string $modelLabel = 'Ahli Gizi';

    protected static ?string $navigationBadgeTooltip = 'Total Data Ahli Gizi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Spesialis')
                    ->required()
                    ->validationMessages([
                        'required' => 'Nama Spesialis wajib diisi',
                    ])
                    ->minLength(3)
                    ->maxLength(255),
                Select::make('gender')
                    ->label('Gender')
                    ->string()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->native(false)
                    ->validationMessages([
                        'required' => 'Gender wajib dipilih',
                    ])
                    ->required(),
                FileUpload::make('image')
                    ->label('Gambar Spesialis')
                    ->directory('image/specialists')
                    ->disk('public')
                    ->image()
                    ->validationMessages([
                        'required' => 'Gambar Spesialis wajib diisi',
                    ])
                    ->required()
                    ->afterStateUpdated(function ($record) {
                        if ($record && $record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
                TextInput::make('telp')
                    ->label('No. Telp')
                    ->numeric()
                    ->tel()
                    ->required()
                    ->validationMessages([
                        'required' => 'No Telp wajib diisi',
                    ])
                    ->minLength(10),
                TextInput::make('specialist')
                    ->label('Spesialis')
                    ->required()
                    ->validationMessages([
                        'required' => 'Spesialis wajib diisi',
                    ])
                    ->minLength(4)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label('Nama Spesialis')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Gender Spesialis')
                    ->formatStateUsing(function ($state) {
                        return $state === 'L' ? 'Laki-laki' : ($state === 'P' ? 'Perempuan' : '-');
                    }),
                ImageColumn::make('image')
                    ->label('Gambar Spesialis')
                    ->circular()
                    ->size(80),
                TextColumn::make('telp')
                    ->label('No Telp'),
                TextColumn::make('specialist')
                    ->label('Spesialis'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->after(function ($record) {
                        // delete image
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListNutritionists::route('/'),
            'create' => CreateNutritionist::route('/create'),
            'edit' => EditNutritionist::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }
}