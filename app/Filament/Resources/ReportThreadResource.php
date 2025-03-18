<?php

namespace App\Filament\Resources;

use App\Models\Thread;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ReportThreadResource\Pages\ViewReportThread;
use App\Filament\Resources\ReportThreadResource\Pages\ListReportThreads;
use App\Filament\Resources\ReportThreadResource\RelationManagers\ReportThreadRelationManager;

class ReportThreadResource extends Resource
{
    protected static ?string $model = Thread::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationLabel = 'Thread';

    protected static ?string $slug = 'report-thread';

    protected static ?string $modelLabel = 'Thread';

    protected static ?string $navigationGroup = 'Data Laporan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama Pemilik Thread'),
                TextInput::make('title')
                    ->label('Judul Thread'),
                Textarea::make('content')
                    ->label('Isi Konten')
                    ->columnSpanFull()
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
                    ->label('Nama Pemilik Thread'),
                TextColumn::make('title')
                    ->label('Judul Thread'),
                TextColumn::make('reports_count')
                    ->label('Total Laporan')
                    ->suffix(' laporan')
                    ->color('danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->color('info'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ReportThreadRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReportThreads::route('/'),
            'view' => ViewReportThread::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('reports', function ($query) {
                $query->where('category_report', 'thread');
            })
            ->withCount('reports');
    }
}
