<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleReportResource\Pages;
use App\Filament\Resources\SaleReportResource\RelationManagers;
use App\Models\Orders;
use App\Models\SaleReport;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class SaleReportResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationGroup = "Inventory";
    protected static ?string $navigationLabel = "Laporan Penjualan";
    protected static ?string $label = "Laporan Penjualan";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Nama Produk'),
                TextColumn::make('user.name')
                    ->label('Nama Pembeli'),
                TextColumn::make('status')
                    ->label('Status Pesanan')
                    ->badge()
                    ->color(function ($record) {
                        return match ($record->status) {
                            'settlement' => 'success',
                            'pending' => 'warning',
                            'expiry' => 'danger',
                            default => 'warning'
                        };
                    }),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->formatStateUsing(function ($record) {
                        Carbon::setLocale('id');
                        return Carbon::parse($record->created_at)->isoFormat('dddd, D MMMM Y HH:mm:ss');
                    }),
                TextColumn::make('sub_total')
                    ->label('Total Pembayaran')
                    ->formatStateUsing(function ($record) {
                        return $record->summerizePrice();
                    })

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->label('Ekspor Ke Excel')
                        ->exports([
                            ExcelExport::make()
                                ->fromTable()
                                ->askForWriterType()
                                ->withFilename(fn($resource) => 'Penjualan - ' . date('Y-m-d H:i:s'))
                        ]),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSaleReports::route('/'),
            'create' => Pages\CreateSaleReport::route('/create'),
            'edit' => Pages\EditSaleReport::route('/{record}/edit'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
