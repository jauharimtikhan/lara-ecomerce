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
use Intervention\Image\ImageManager;
use Modules\Admin\Helpers\AbstractAdminClass;
use Illuminate\Support\Str;
use Modules\Admin\App\Livewire\Product;
use Ramsey\Uuid\Uuid;

class EditProduct extends AbstractAdminClass implements HasForms
{
    use InteractsWithForms;
    protected static string|array $middleware = ['auth'];
    protected static string $navigationIcon = 'heroicon-o-archive-box';
    protected static string $navigationLabel = 'Edit Produk';
    protected static bool $headerAction = false;
    protected static ?string $heading = 'Edit Produk';
    public ?array $data = [];
    public function mount(string $id): void
    {
        $this->data = ModelsProduct::find($id)->toArray();
        $this->data['id'] = $id;
        $this->form->fill($this->data);
    }
    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(4)->schema([
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
                            ->inputMode('numeric')
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
                        })
                        ->panelLayout('grid'),
                    Grid::make(2)->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(1),
                        Toggle::make('is_featured')
                            ->label('Produk terbaru')
                            ->default(false),
                    ])
                ])
                    ->columns(1)
                    ->columnSpan(1)
            ]),
        ])
            ->statePath('data')
            ->model(ModelsProduct::class);
    }

    public function update()
    {
        try {
            $this->handleRecordUpdate($this->form->getState(), ModelsProduct::find($this->data['id']));
            Notification::make()
                ->title('Berhasil Mengupdate Data Produk!')
                ->success()
                ->send();
        } catch (\Throwable $th) {
            dd($th);
            Notification::make()
                ->title('Gagal Mengupdate Data Produk!')
                ->danger()
                ->send();
            //throw $th;
        }
        //  $this->redirect(route('admin.product'), true);
    }
    public static function handleRecordUpdate(array $data, ModelsProduct $record)
    {
        if (!empty($data['thumbnail']) && $data['thumbnail'] !== $record->thumbnail) {
            Storage::disk('public')->delete($record->thumbnail);
            $record->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'thumbnail' => $data['thumbnail'],
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $data['category_id'],
                'user_id' => $data['user_id'],
                'is_active' => $data['is_active'] ? 1 : 0,
                'is_featured' => $data['is_featured'] ? 1 : 0,
            ]);
        } else {
            $record->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'thumbnail' => $data['thumbnail'],
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $data['category_id'],
                'user_id' => $data['user_id'],
                'is_active' => $data['is_active'] ? 1 : 0,
                'is_featured' => $data['is_featured'] ? 1 : 0,
            ]);

        }
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

    public function pages()
    {
        return [
            'index' => Product::class,
            // 'create' => CreateProduct::class,
        ];
    }

    public function render()
    {
        return view('admin::pages.resource.product-resource.edit');
    }
}
