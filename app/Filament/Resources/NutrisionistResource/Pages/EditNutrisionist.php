<?php

namespace App\Filament\Resources\NutrisionistResource\Pages;

use App\Filament\Resources\NutrisionistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNutrisionist extends EditRecord
{
    protected static string $resource = NutrisionistResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}