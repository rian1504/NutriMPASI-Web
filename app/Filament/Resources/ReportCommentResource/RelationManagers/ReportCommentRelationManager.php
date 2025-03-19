<?php

namespace App\Filament\Resources\ReportCommentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Report;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ReportCommentRelationManager extends RelationManager
{
    protected static string $relationship = 'reports';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Laporan')
                    ->description(fn(Report $record): string => $record->content),
                TextColumn::make('created_at')->label('Dilaporkan Pada')->date('l, d F Y'),
            ]);
    }
}