<?php

namespace App\Filament\Resources\ReportFoodResource\RelationManagers;

use App\Models\Report;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;

class FoodReportRelationManager extends RelationManager
{
    protected static string $relationship = 'reports';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Laporan')
                    ->description(fn(Report $record): string => $record->content),
                TextColumn::make('created_at')->label('Dilaporkan Pada')->date('l, d F Y'),
            ])
            ->filters([])
            ->actions([]);
    }
}
