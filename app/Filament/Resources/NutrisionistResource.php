<?php

namespace App\Filament\Resources;

use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Nutrisionist;
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
use App\Filament\Resources\NutrisionistResource\Pages;
use App\Filament\Resources\NutrisionistResource\RelationManagers;
use App\Filament\Resources\NutrisionistResource\Pages\EditNutrisionist;
use App\Filament\Resources\NutrisionistResource\Pages\ListNutrisionists;
use App\Filament\Resources\NutrisionistResource\Pages\CreateNutrisionist;

class NutrisionistResource extends Resource
{
    protected static ?string $model = Nutrisionist::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Ahli Gizi';

    protected static ?string $slug = 'nutrisionists';

    protected static ?string $modelLabel = 'Ahli Gizi';

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
                    ->maxLength(255),
                FileUpload::make('image')
                    ->label('Gambar Spesialis')
                    ->directory('image/spesialis')
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
                    ]),
                TextInput::make('spesialist')
                    ->label('Spesialist')
                    ->required()
                    ->validationMessages([
                        'required' => 'Spesialist wajib diisi',
                    ])
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
                ImageColumn::make('image')
                    ->label('Gambar Spesialis')
                    ->circular()
                    ->size(80),
                TextColumn::make('telp')
                    ->label('No Telp'),
                TextColumn::make('spesialist')
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
            'index' => ListNutrisionists::route('/'),
            'create' => CreateNutrisionist::route('/create'),
            'edit' => EditNutrisionist::route('/{record}/edit'),
        ];
    }
}