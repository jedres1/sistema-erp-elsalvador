<?php

namespace App\Filament\Resources\AccountCatalogResource\Pages;

use App\Filament\Resources\AccountCatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccountCatalog extends EditRecord
{
    protected static string $resource = AccountCatalogResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
