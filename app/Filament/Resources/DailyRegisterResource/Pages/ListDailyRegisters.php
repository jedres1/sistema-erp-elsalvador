<?php

namespace App\Filament\Resources\DailyRegisterResource\Pages;

use App\Filament\Resources\DailyRegisterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyRegisters extends ListRecords
{
    protected static string $resource = DailyRegisterResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
