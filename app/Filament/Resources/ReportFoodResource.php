<?php

namespace App\Filament\Resources;

use App\Models\Food;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FoodCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ReportFoodResource\Pages\ListReportFood;
use App\Filament\Resources\ReportFoodResource\Pages\ViewReportFood;
use App\Filament\Resources\ReportFoodResource\RelationManagers\ReportFoodRelationManager;

class ReportFoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationLabel = 'Usulan Makanan';

    protected static ?string $slug = 'report-food';

    protected static ?string $modelLabel = 'Usulan Makanan';

    protected static ?string $navigationGroup = 'Data Laporan';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationBadgeTooltip = 'Total Laporan Usulan Makanan';

    public static function form(Form $form): Form
    {
        $category = FoodCategory::all()->pluck('name', 'id');

        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama Pemilik Makanan'),
                TextInput::make('name')
                    ->label('Nama Makanan'),
                Select::make('food_category_id')
                    ->label('Kategori')
                    ->options($category)
                    ->native(false),
                TextInput::make('age')
                    ->label('Umur')
                    ->suffix('bulan'),
                Fieldset::make('nutrition')
                    ->label('Kandungan Gizi')
                    ->schema([
                        TextInput::make('energy')
                            ->label('Energi')
                            ->columnSpanFull()
                            ->suffix('kkal'),
                        TextInput::make('protein')
                            ->label('Protein')
                            ->suffix('gr'),
                        TextInput::make('fat')
                            ->label('Lemak')
                            ->suffix('gr'),
                    ]),
                TextInput::make('portion')
                    ->columnSpanFull()
                    ->label('Porsi'),
                FileUpload::make('image')
                    ->label('Gambar Makanan')
                    ->columnSpanFull()
                    ->directory('image/foods'),
                Textarea::make('fruit')
                    ->label('Buah')
                    ->autosize(),
                Textarea::make('recipe')
                    ->label('Resep')
                    ->autosize(),
                Textarea::make('step')
                    ->label('Langkah memasak')
                    ->autosize(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->autosize(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('user.name')
                    ->label('Nama Pemilik Makanan'),
                TextColumn::make('name')
                    ->label('Nama Makanan'),
                ImageColumn::make('image')
                    ->label('Gambar Makanan')
                    ->square()
                    ->size(80),
                TextColumn::make('reports_count')
                    ->label('Total Laporan')
                    ->suffix(' laporan')
                    ->color('danger'),
            ])
            ->actions([
                ViewAction::make()
                    ->color('info'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReportFood::route('/'),
            'view' => ViewReportFood::route('/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            ReportFoodRelationManager::class
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('reports', function ($query) {
                $query->where('category_report', 'food');
            })
            ->withCount('reports');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}