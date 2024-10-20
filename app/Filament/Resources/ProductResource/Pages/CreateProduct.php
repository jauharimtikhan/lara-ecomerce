<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected ?string $heading = "Buat Produk Baru";

    protected function getCreateAnotherFormAction(): Actions\Action
    {

        return Actions\Action::make('createAnother')
            ->label('Simpan & Buat Baru')
            ->color('gray')
            ->action('createAnother');
    }
}
