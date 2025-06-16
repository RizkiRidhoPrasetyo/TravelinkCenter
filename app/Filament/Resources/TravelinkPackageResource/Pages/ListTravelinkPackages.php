<?php

namespace App\Filament\Resources\TravelinkPackageResource\Pages;

use App\Filament\Resources\TravelinkPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTravelinkPackages extends ListRecords
{
    protected static string $resource = TravelinkPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
