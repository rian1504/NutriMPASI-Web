<?php

namespace App\Filament\Resources\FoodCategoryResource\Pages;

use App\Filament\Resources\FoodCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodCategory extends CreateRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}