<?php

namespace App\Filament\Resources\HomeCmsResource\Pages;

use App\Filament\Resources\HomeCmsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeCms extends ListRecords
{
    protected static string $resource = HomeCmsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
