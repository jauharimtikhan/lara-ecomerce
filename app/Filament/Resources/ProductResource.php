<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Auth;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-archive-box';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $navigationGroup = "Inventory";
    protected static ?string $label = "Produk";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make()->schema([
                        Grid::make()->schema([
                            TextInput::make('name')
                                ->label('Nama Produk')
                                ->placeholder('Masukan Nama Produk')
                                ->live(debounce: 5000)
                                ->required()
                                ->afterStateUpdated(function ($state, Set $set) {
                                    $set('slug', Str::slug($state));
                                }),
                            TextInput::make('slug')
                                ->label('slug')
                                ->readonly()
                                ->required()
                                ->placeholder('Otomatis Terisi!!!'),
                            Grid::make()->schema([
                                TextInput::make('price')
                                    ->label('Harga Produk')
                                    ->numeric()
                                    ->placeholder('Masukan Harga Produk')
                                    ->extraInputAttributes(['oninput' => "this.value = this.value.replace(/[^0-9]/g, '');"]) // Membatasi input hanya angka
                                    ->live(),
                                Select::make('category_id')
                                    ->options(function () {
                                        $record = Category::select('id', 'name')->get();
                                        return $record->pluck('name', 'id');
                                    })
                                    ->required()
                                    ->native(false)
                                    ->searchable()
                                    ->live()
                                    ->label('Kategori Produk')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nama Kategori')
                                            ->placeholder('Masukan Nama Kategori')
                                    ]),
                                Select::make('sub_category_id')
                                    ->label('Sub Kategori Produk')
                                    ->placeholder('Pilih Sub Kategori')
                                    ->options(function (callable $get) {
                                        $record = SubCategory::select('id', 'name', 'category_id')->where('category_id', $get('category_id'))->get();
                                        return $record->pluck('name', 'id');
                                    })
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nama Kategori')
                                            ->placeholder('Masukan Nama Kategori')
                                    ])
                                    ->createOptionUsing(function (callable $get, $data) {
                                        $category = Category::find($get('category_id'));
                                        SubCategory::create([
                                            'name' => $data['name'],
                                            'category_id' => $category->id
                                        ]);
                                    })
                                    ->disabled(fn($get) => empty($get('category_id')))
                                    ->live()
                                    ->native(false),
                                TextInput::make('stock')
                                    ->label('Stok Produk')
                                    ->placeholder('Masukan Jumlah Stok Produk')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1),
                                Select::make('user_id')
                                    ->label('Dibuat Oleh')
                                    ->options(function () {
                                        $record = User::select('id', 'name')->get();
                                        return $record->pluck('name', 'id');
                                    })
                                    ->required()
                                    ->native(false)
                                    ->searchable()
                                    ->default(fn() => Auth::user()->id),
                                TextInput::make('weight')
                                    ->label('Berat Produk')
                                    ->placeholder('Masukan Berat Produk')
                                    ->suffix('gram')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0),

                            ])->columns(2),
                            Textarea::make('description')
                                ->label('Deskripsi Produk')
                                ->columnSpan(2)
                                ->required()
                                ->placeholder('Masukan Deskripsi Produk')
                                ->rows(10),
                        ])
                    ])
                        ->columnSpan(8),
                    Section::make()->schema([
                        CuratorPicker::make('thumbnail')
                            ->label('Thumbnail Produk')
                            ->listDisplay(false)
                            ->required()
                            ->buttonLabel('Upload Thumbnail'),
                        CuratorPicker::make('product_galleries')
                            ->label('Gambar Galleri Produk')
                            ->listDisplay(false)
                            ->buttonLabel('Upload Galleri Produk')
                            ->multiple(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Toggle::make('is_featured')
                            ->default(false)
                            ->label('Produk Unggulan'),
                    ])->columnSpan(4),
                ])->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Produk'),
                TextColumn::make('price')
                    ->label('Harga')
                    ->sortable()
                    ->money('IDR', true),
                TextColumn::make('is_active')
                    ->label('Aktif')
                    ->badge()
                    ->color(function (Product $record) {
                        return $record->is_active == 1 ? 'success' : 'danger';
                    })
                    ->formatStateUsing(function (Product $record) {
                        return $record->is_active == 1 ? 'Ya' : 'Tidak';
                    }),
                TextColumn::make('is_featured')
                    ->label('Produk Unggulan')
                    ->badge()
                    ->color(function (Product $record) {
                        return $record->is_featured == 1 ? 'success' : 'danger';
                    })
                    ->formatStateUsing(function (Product $record) {
                        return $record->is_featured == 1 ? 'Ya' : 'Tidak';
                    }),
                CuratorColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->circular()
                    ->size(30),
                CuratorColumn::make('product_galleries')
                    ->label('Gallery Produk')
                    ->circular()
                    ->stacked()
                    ->size(30)
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Produk'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
