<?php

namespace App\Filament\Resources;

use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FoodCategory;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FoodCategoryResource\RelationManagers;
use App\Filament\Resources\FoodCategoryResource\Pages\EditFoodCategory;
use App\Filament\Resources\FoodCategoryResource\Pages\CreateFoodCategory;
use App\Filament\Resources\FoodCategoryResource\Pages\ListFoodCategories;

class FoodCategoryResource extends Resource
{
    protected static ?string $model = FoodCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Kategori Makanan';

    protected static ?string $slug = 'food-categories';

    protected static ?string $modelLabel = 'Kategori Makanan';

    protected static ?string $navigationGroup = 'Data Makanan';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationBadgeTooltip = 'Total Data Kategori Makanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Kategori Makanan')
                    ->required()
                    ->validationMessages([
                        'required' => 'Nama Kategori Makanan wajib diisi',
                    ])
                    ->minLength(3)
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
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),
            ])->defaultSort('id', 'desc')
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
            'index' => ListFoodCategories::route('/'),
            'create' => CreateFoodCategory::route('/create'),
            'edit' => EditFoodCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }
}