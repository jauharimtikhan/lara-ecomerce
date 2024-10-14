<?php

namespace Modules\Admin\App\Livewire;

use App\Models\Product as ModelsProduct;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Admin\App\Livewire\Resources\ProductResource\CreateProduct;
use Modules\Admin\Helpers\AbstractAdminClass;

class Product extends AbstractAdminClass implements HasForms, HasTable
{

    use InteractsWithForms, InteractsWithTable;
    protected static string|array $middleware = ['auth', 'role:admin|super_adminn'];
    protected static string $navigationIcon = 'heroicon-o-archive-box';
    protected static string $navigationLabel = 'Produk';
    protected static bool $headerAction = true;
    protected static ?string $heading = 'Produk';
    protected static ?string $navigationGroup = 'Data Produk';

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsProduct::query())
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Produk'),
                TextColumn::make('category.name')
                    ->label('Kategori'),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', 0, 'id'),
                TextColumn::make('is_active')
                    ->label('Aktif')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {

                        '1' => 'success',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        true => 'Produk Aktif',
                        false => 'Produk Tidak Aktif',
                    }),
                TextColumn::make('is_featured')
                    ->label('Produk Unggulan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        '1' => 'success',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        true => 'Ya',
                        false => 'Tidak',
                    }),
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail Produk')
                    ->circular(),
                ImageColumn::make('product_galleries')
                    ->label('Galeri Produk')
                    ->circular()
                    ->stacked(true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make('edit')
                    ->label('Edit')
                    ->url(fn(ModelsProduct $record): string => route('admin.editproduct', $record)),
                DeleteAction::make('delete')
                    ->label('Hapus')
            ])
            ->bulkActions([
                DeleteBulkAction::make('delete'),
                RestoreBulkAction::make('restore'),
            ]);
    }

    public function render()
    {
        return view('admin::pages.product');
    }



    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public function pages()
    {
        return [
            'index' => Product::class,
            'create' => CreateProduct::class,
            // 'edit' => EditProduct::class
        ];
    }
}
