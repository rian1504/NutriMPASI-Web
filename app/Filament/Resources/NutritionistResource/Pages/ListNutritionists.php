<?php

namespace App\Filament\Resources\NutritionistResource\Pages;

use App\Filament\Resources\NutritionistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNutritionists extends ListRecords
{
    protected static string $resource = NutritionistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
