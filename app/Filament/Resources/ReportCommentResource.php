<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Comment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Comment\ReportComment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReportCommentResource\Pages;
use App\Filament\Resources\ReportCommentResource\RelationManagers;
use App\Filament\Resources\ReportCommentResource\Pages\ViewReportComment;
use App\Filament\Resources\ReportCommentResource\Pages\ListReportComments;
use App\Filament\Resources\ReportCommentResource\RelationManagers\ReportCommentRelationManager;

class ReportCommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Komentar';

    protected static ?string $slug = 'report-comment';

    protected static ?string $modelLabel = 'Komentar';

    protected static ?string $navigationGroup = 'Data Laporan';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationBadgeTooltip = 'Total Laporan Komentar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama Pemilik Komentar'),
                Select::make('thread_id')
                    ->relationship('thread', 'title')
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
                    ->label('Nama Pemilik Komentar'),
                TextColumn::make('thread.title')
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
            ReportCommentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReportComments::route('/'),
            'view' => ViewReportComment::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('reports', function ($query) {
                $query->where('category', 'comment');
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
