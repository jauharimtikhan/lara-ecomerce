<?php

namespace Modules\Admin\App\Livewire\Resources\ProductResource;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use App\Models\SubCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\App\Livewire\Product;
use Modules\Admin\Helpers\AbstractAdminClass;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class CreateProduct extends AbstractAdminClass implements HasForms
{

    use InteractsWithForms;
    protected static string|array $middleware = ['auth'];
    protected static string $navigationIcon = 'heroicon-o-archive-box';
    protected static string $navigationLabel = 'Buat Produk';
    protected static bool $headerAction = false;
    protected static ?string $heading = 'Buat Produk';
    public ?array $data = [];
    public function mount(): void
    {
        $this->form->fill();
    }
    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(5)->schema([
                Section::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->placeholder('Masukan Nama Produk')
                            ->rules('required')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->hint('Otomatis Terisi')
                            ->hintColor('primary')
                            ->placeholder('Otomatis Terisi...')
                            ->readonly(),
                        TextInput::make('price')
                            ->label('Harga Produk')
                            ->placeholder('Masukan Harga Produk')
                            ->rules('required')
                            ->reactive()
                            ->required()
                            ->live(debounce: 3000)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),
                        TextInput::make('stock')
                            ->label('Stok Produk')
                            ->numeric()
                            ->required()
                            ->placeholder('Masukan Jumlah Stok Produk')
                            ->rules('required'),
                        Grid::make()->schema([
                            Select::make('category_id')
                                ->label('Kategori Produk')
                                ->native()
                                ->required()
                                ->options(Category::all()->pluck('name', 'id'))
                                ->relationship('category', 'name')
                                ->searchable(),
                            Select::make('sub_category_id')
                                ->label('Sub Kategori Produk')
                                ->native()
                                ->required()
                                ->options(SubCategory::all()->pluck('name', 'id'))
                                ->relationship('subcategory', 'name')
                                ->searchable(),
                            Select::make('user_id')
                                ->label('Dibuat Oleh')
                                ->relationship('users', 'name')
                                ->searchable()
                                ->default(Auth::user()->id),
                        ])->columns(3),
                    ])->columns(2),
                    Textarea::make('description')
                        ->label('Deskripsi Produk')
                        ->placeholder('Masukan Deskripsi Produk')
                        ->autosize()
                        ->required()
                        ->helperText('Masukan Kurang Lebih 100 Karakter')
                ])
                    ->columns(1)
                    ->columnSpan(3),
                Section::make()->schema([
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail Produk')
                        ->required()
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048)
                        ->helperText('Ukuran Maksimal 2 MB')
                        ->disk('public')
                        ->directory('product/thumbnail')
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('product/thumbnail')) {
                                Storage::disk('public')->makeDirectory('product/thumbnail');
                            }
                            $image->toWebP(10)->save("storage/{$path}");
                            return $path;
                        }),
                    FileUpload::make('product_galleries')
                        ->label('Galeri Produk')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('product/product_galleries')
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            return $this->uploadProductGallery($component, $file);
                        }),
                    Grid::make(3)->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->columnSpan(1),
                        Toggle::make('is_featured')
                            ->label('Produk Unggulan')
                            ->columnSpan(2),
                    ])
                ])
                    ->columns(1)
                    ->columnSpan(2)
            ]),
        ])
            ->statePath('data')
            ->model(ModelsProduct::class);
    }

    public function create()
    {
        ModelsProduct::create($this->form->getState());
        Notification::make()
            ->title('Berhasil Menambaahkan Produk Baru!')
            ->success()
            ->send();
    }

    private function uploadProductGallery(FileUpload $component, $file)
    {
        $manager = ImageManager::gd();
        $image = $manager->read($file);
        $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
        if (!Storage::disk('public')->exists('product/product_galleries')) {
            Storage::disk('public')->makeDirectory('product/product_galleries');
        }
        $image->toWebP(10)->save("storage/{$path}");
        return $path;
    }

    public function render()
    {
        return view('admin::pages.resource.product-resource.create');
    }

    public function pages()
    {
        return [
            Product::class,
            CreateProduct::class
        ];
    }
}
