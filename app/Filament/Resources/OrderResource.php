<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\CuratorMedia;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'fas-cart-flatbed';
    protected static ?string $label = 'Pesanan';
    protected static ?string $NavigationLabel = 'Pesanan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('status')
                        ->options([
                            'pending' => 'Menunggu Pembayaran',
                            'settlement' => 'Perlu Dikirim',
                            'cancel' => 'Batalkan',
                            'proses' => 'Dalam Proses',
                            'selesai' => 'Selesai',
                        ])
                        ->label('Status')
                        ->native(false)

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email')
                    ->label('Pembeli'),
                ViewColumn::make('products')
                    ->view('tables.columns.orders-product-detail', [
                        'products' => function ($record) {
                            $product = [];
                            foreach ($record->products as  $value) {
                                $product[] = Product::with('gambarThumbnail')->where('id', $value['id'])->get();
                            }


                            return $product;
                        }
                    ])
                    ->label('Produk'),
                TextColumn::make('quantity')
                    ->label('Jumlah'),
                TextColumn::make('total_price')
                    ->money('IDR', true)
                    ->label('Total Harga'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->formatStateUsing(function ($record) {
                        Carbon::setLocale('id');
                        return Carbon::parse($record->created_at)->isoFormat('dddd, D MMMM Y HH:mm:ss');
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'pending' => 'warning',
                            'settlement' => 'success',
                            'cancel' => 'danger',
                            'expiry' => 'danger',
                            'proses' => 'info',
                            'selesai' => 'success',
                            default => 'danger',
                        };
                    })
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => 'Menunggu Pembayaran',
                            'settlement' => 'Perlu Dikirim',
                            'expiry' => 'Kadaluarsa',
                            'cancel' => 'Dibatalkan',
                            'proses' => 'Dalam Proses',
                            'selesai' => 'Selesai',
                            default => 'Menunggu Pembayaran',
                        };
                    }),
                TextColumn::make('transaction_id')
                    ->label('Nomor Transaksi')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Update Pesanan')
                    ->hidden(function ($record) {
                        return $record->status == 'pending';
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ManageOrders::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'settlement')->count();
    }
}
