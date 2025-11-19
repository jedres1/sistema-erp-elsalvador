<?php

namespace App\Filament\Resources\DashboardResource\Pages;

use App\Filament\Resources\DashboardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class Dashboard extends ListRecords
{
    protected static string $resource = DashboardResource::class;
}
