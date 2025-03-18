<?php

namespace App\Filament\Resources\ReportFoodResource\Pages;

use App\Filament\Resources\ReportFoodResource;
use Filament\Resources\Pages\ListRecords;

class ListReportFood extends ListRecords
{
    protected static string $resource = ReportFoodResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}