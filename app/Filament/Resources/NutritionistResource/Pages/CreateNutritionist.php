<?php

namespace App\Filament\Resources\NutritionistResource\Pages;

use App\Filament\Resources\NutritionistResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNutritionist extends CreateRecord
{
    protected static string $resource = NutritionistResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
