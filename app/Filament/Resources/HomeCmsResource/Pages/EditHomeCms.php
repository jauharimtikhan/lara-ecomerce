<?php

namespace App\Filament\Resources\HomeCmsResource\Pages;

use App\Filament\Resources\HomeCmsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeCms extends EditRecord
{
    protected static string $resource = HomeCmsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
