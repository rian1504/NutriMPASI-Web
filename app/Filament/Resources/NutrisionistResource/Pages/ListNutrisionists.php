<?php

namespace App\Filament\Resources\NutrisionistResource\Pages;

use App\Filament\Resources\NutrisionistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNutrisionists extends ListRecords
{
    protected static string $resource = NutrisionistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
