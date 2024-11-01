<?php

namespace App\Filament\Pages;

use App\Filament\Resources\OrderResource\Widgets\RAisedSales;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $label = 'Dashboard';
    protected ?string $heading = 'Dashboard';
    public function getWidgets(): array
    {
        return [
            RAisedSales::class
        ];
    }

    public function getColumns(): int|string|array
    {
        return 1;
    }
}
