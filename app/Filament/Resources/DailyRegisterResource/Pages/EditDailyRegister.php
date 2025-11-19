<?php

namespace App\Filament\Resources\DailyRegisterResource\Pages;

use App\Filament\Resources\DailyRegisterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyRegister extends EditRecord
{
    protected static string $resource = DailyRegisterResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
