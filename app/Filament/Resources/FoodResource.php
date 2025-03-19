<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Food;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FoodCategory;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
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
use App\Filament\Resources\FoodResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FoodResource\Pages\EditFood;
use App\Filament\Resources\FoodResource\Pages\ListFood;
use App\Filament\Resources\FoodResource\Pages\CreateFood;
use App\Filament\Resources\FoodResource\RelationManagers;

class FoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationLabel = 'Makanan';

    protected static ?string $slug = 'food';

    protected static ?string $modelLabel = 'Makanan';

    protected static ?string $navigationGroup = 'Data Makanan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationBadgeTooltip = 'Total Data Makanan';

    public static function form(Form $form): Form
    {
        $category = FoodCategory::all()->pluck('name', 'id');

        return $form
            ->schema([
                Select::make('food_category_id')
                    ->label('Kategori')
                    ->options($category)
                    ->native(false)
                    ->validationMessages([
                        'required' => 'Kategori wajib dipilih',
                    ])
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Makanan')
                    ->required()
                    ->validationMessages([
                        'required' => 'Nama Makanan wajib diisi',
                    ])
                    ->minLength(4)
                    ->maxLength(255),
                Select::make('source')
                    ->label('Sumber')
                    ->string()
                    ->options([
                        'KEMENKES' => 'KEMENKES',
                        'WHO' => 'WHO',
                    ])
                    ->native(false)
                    ->validationMessages([
                        'required' => 'Sumber wajib dipilih',
                    ])
                    ->required(),
                Select::make('age')
                    ->label('Umur')
                    ->string()
                    ->options([
                        '6-8' => '6-8',
                        '9-11' => '9-11',
                        '12-23' => '12-23',
                    ])
                    ->native(false)
                    ->validationMessages([
                        'required' => 'Umur wajib dipilih',
                    ])
                    ->required(),
                Fieldset::make('nutrition')
                    ->label('Kandungan Gizi')
                    ->schema([
                        TextInput::make('energy')
                            ->label('Energi')
                            ->numeric()
                            ->columnSpanFull()
                            ->suffix('kkal')
                            ->required()
                            ->validationMessages([
                                'required' => 'Energi wajib diisi',
                                'minValue' => 'Energi tidak boleh kurang dari 0 kkal',
                            ])
                            ->minValue(0),
                        TextInput::make('protein')
                            ->label('Protein')
                            ->numeric()
                            ->suffix('gr')
                            ->required()
                            ->validationMessages([
                                'required' => 'Protein wajib diisi',
                                'minValue' => 'Protein tidak boleh kurang dari 0 gr',
                            ])
                            ->minValue(0),
                        TextInput::make('fat')
                            ->label('Lemak')
                            ->numeric()
                            ->suffix('gr')
                            ->required()
                            ->validationMessages([
                                'required' => 'Lemak wajib diisi',
                                'minValue' => 'Lemak tidak boleh kurang dari 0 gr',
                            ])
                            ->minValue(0),
                    ]),
                TextInput::make('portion')
                    ->label('Porsi')
                    ->numeric()
                    ->columnSpanFull()
                    ->required()
                    ->validationMessages([
                        'required' => 'Porsi wajib diisi',
                        'minValue' => 'Porsi tidak boleh kurang dari 0',
                    ])
                    ->minValue(0),
                FileUpload::make('image')
                    ->label('Gambar Makanan')
                    ->columnSpanFull()
                    ->directory('image/foods')
                    ->disk('public')
                    ->image()
                    ->validationMessages([
                        'required' => 'Gambar Makanan wajib diisi',
                    ])
                    ->required()
                    ->afterStateUpdated(function ($record) {
                        if ($record && $record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
                Textarea::make('fruit')
                    ->label('Buah')
                    ->autosize(),
                Textarea::make('recipe')
                    ->label('Resep')
                    ->autosize()
                    ->required(),
                Textarea::make('step')
                    ->label('Langkah memasak')
                    ->autosize()
                    ->required(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->autosize()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $category = FoodCategory::all()->pluck('name', 'id');

        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('food_category.name')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Makanan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('source')
                    ->label('Sumber')
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Gambar Makanan')
                    ->square()
                    ->size(80),
                TextColumn::make('age')
                    ->label('Umur')
                    ->sortable()
                    ->suffix(' Bulan'),
            ])->defaultSort('id', 'desc')
            ->filters([
                Filter::make('food_category_id')
                    ->form([
                        Select::make('food_category_id')
                            ->label('Kategori')
                            ->options($category)
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['food_category_id'],
                                fn(Builder $query, $data): Builder => $query->where('food_category_id', $data),
                            );
                    }),
                Filter::make('source')
                    ->form([
                        Select::make('source')
                            ->label('Source')
                            ->options([
                                'KEMENKES' => 'KEMENKES',
                                'WHO' => 'WHO'
                            ])
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['source'],
                                fn(Builder $query, $data): Builder => $query->where('source', $data),
                            );
                    }),
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
            'index' => ListFood::route('/'),
            'create' => CreateFood::route('/create'),
            'edit' => EditFood::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', null);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }
}