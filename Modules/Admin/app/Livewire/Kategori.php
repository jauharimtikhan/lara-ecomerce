<?php

namespace Modules\Admin\App\Livewire;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Admin\Helpers\AbstractAdminClass;

class Kategori extends AbstractAdminClass implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;
    protected static array|string $middleware = ['auth', 'role:admin|super_admin'];
    protected static string $navigationGroup = 'Kategori';
    protected static string $navigationIcon = 'bxs-category';
    protected static string $navigationLabel = 'Kategori';
    protected static bool $headerAction = false;
    protected static ?string $heading = 'Kategori';



    public function table(Table $table): Table
    {
        return $table
            ->query(Category::query())
            ->heading(function () {
                return static::$heading;
            })
            ->headerActions(
                [
                    CreateAction::make('create')
                        ->label('Buat Kategori')
                        ->form([
                            TextInput::make('name')
                                ->rules('required')
                                ->label('Nama Kategori')
                                ->placeholder('Masukkan Nama Kategori'),
                        ])
                        ->modalHeading('Buat Kategori')
                        ->createAnother(false)
                ]
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                    ->label('Edit')
                    ->form([
                        TextInput::make('name')
                            ->label('Kategori')
                    ]),
                DeleteAction::make('delete')
                    ->label('Hapus')
            ])
            ->bulkActions([
                // ...
            ])
        ;
    }


    public function render()
    {
        return view('admin::pages.kategori');
    }

    protected function pages(): string|array
    {
        return [
            'index' => Kategori::class,
            'subcategory' => SubCategory::class
        ];
    }
}
