<?php

namespace App\Filament\Resources\AccountCatalogResource\Pages;

use App\Filament\Resources\AccountCatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountCatalogs extends ListRecords
{
    protected static string $resource = AccountCatalogResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
