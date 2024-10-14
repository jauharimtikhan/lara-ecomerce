<?php
namespace Modules\Admin\App\Livewire;

use App\Models\Category;
use App\Models\SubCategory as ModelsSubCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Admin\Helpers\AbstractAdminClass;
use Modules\Admin\View\Components\Button;

class SubCategory extends AbstractAdminClass implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;
    protected static array|string $middleware = ['auth', 'role:admin|super_admin'];
    protected static string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string $navigationLabel = 'Sub Kategori';
    protected static bool $headerAction = false;
    protected static ?string $heading = 'Sub Kategori';

    public ?array $dataCreateSubCategory = [];

    public function mount()
    {
        $this->createSubCategoryForm->fill();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsSubCategory::query())
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Sub Kategori'),
                TextColumn::make('category.name')
                    ->label('Nama Kategori')
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    })
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                    ->form([
                        TextInput::make('name')
                            ->label('Nama Sub Kategori')
                            ->placeholder('Masukan Nama Sub Kategori')
                            ->rules('required')
                            ->required(),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->native(false)
                            ->options(Category::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->relationship('category', 'name'),
                    ]),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ]);
    }
    protected function getForms(): array
    {
        return [
            'createSubCategoryForm'
        ];
    }

    public function createSubCategoryAction()
    {
        try {
            ModelsSubCategory::create($this->createSubCategoryForm->getState());
            Notification::make()
                ->title('Berhasil Membuat Sub Kategori Baru!')
                ->success()
                ->send();
            $this->dispatch('subCategoryCreated');
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Gagal Membuat Sub Kategori Baru!')
                ->danger()
                ->send();
            $this->dispatch('subCategoryCreated');
        }
    }

    public function createSubCategoryForm(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama Sub Kategori')
                ->placeholder('Masukan Nama Sub Kategori')
                ->rules('required')
                ->required(),
            Select::make('category_id')
                ->label('Kategori')
                ->native(false)
                ->options(Category::all()->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->relationship('category', 'name'),
        ])
            ->statePath('dataCreateSubCategory')
            ->model(ModelsSubCategory::class);
    }

    public function quickAction()
    {
        $button = Button::make('create')
            ->label('Buat Sub Kategori')
            ->attributes([
                'data-modal-toggle' => 'modalSubCategoryCreate',
                'data-modal-target' => 'modalSubCategoryCreate',
            ]);

        return $button->toHtml();

    }

    public function render()
    {
        return view('admin::pages.subcategory');
    }

    public function pages(): array
    {
        return [
            'index' => SubCategory::class,
        ];
    }
}