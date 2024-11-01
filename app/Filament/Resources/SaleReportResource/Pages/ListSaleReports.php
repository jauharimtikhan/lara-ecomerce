<?php

namespace App\Filament\Resources\SaleReportResource\Pages;

use App\Filament\Resources\SaleReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaleReports extends ListRecords
{
    protected static string $resource = SaleReportResource::class;

    protected ?string $heading = "Laporan Penjualan";

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
