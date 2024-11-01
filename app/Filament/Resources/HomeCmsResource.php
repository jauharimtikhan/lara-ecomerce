<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeCmsResource\Pages;
use App\Filament\Resources\HomeCmsResource\RelationManagers;
use App\Models\Category;
use App\Models\HomeCms;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeCmsResource extends Resource
{
    protected static ?string $model = HomeCms::class;

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Tabs::make('Home CMS')->tabs([
                        Tabs\Tab::make('Banner')->schema([
                            CuratorPicker::make('home_banner')
                                ->label('Banner Halaman Utama')
                                ->multiple()
                        ]),
                        Tabs\Tab::make('Kategori')->schema([
                            Select::make('home_category')
                                ->label('Judul Kategori')
                                ->options(Category::with('media')->get()->pluck('name', 'id'))
                                ->placeholder('Pilih Kategori')
                                ->searchable()
                                ->multiple(),

                        ]),
                        Tabs\Tab::make('Flash Sale')->schema([
                            TextInput::make('home_ads.title')
                                ->label('Judul Flash Sale')
                                ->placeholder('Masukan Judul Flash Sale'),
                            TextInput::make('home_ads.cta_label')
                                ->label('Tombol CTA')
                                ->placeholder('Masukan Label Tombol CTA'),
                            TextInput::make('home_ads.cta_link')
                                ->label('Link CTA')
                                ->placeholder('Masukan Link Tombol CTA')
                                ->url()
                                ->suffixIcon('heroicon-m-globe-alt'),
                            Textarea::make('home_ads.description')
                                ->label('Deskripsi Flash Sale')
                                ->placeholder('Masukan Deskripsi Flash Sale'),
                            CuratorPicker::make('home_ads.banner')
                                ->label('Banner Flash Sale'),
                        ]),
                        Tabs\Tab::make('Footer')->schema([
                            RichEditor::make('home_footer')->label('Footer'),
                        ]),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('home_banner')
                    ->label('Banner Halaman Utama')
                    ->stacked()
                    ->circular()
                    ->size(30),
                TextColumn::make('home_category')
                    ->label('Judul Kategori')
                    ->formatStateUsing(function ($record) {
                        $named = [];

                        foreach ($record->home_category as $value) {
                            $named[] = Category::where('id', $value)->first()->name;
                        }
                        return implode(', ', $named);
                    })
                    ->width(30),
                CuratorColumn::make('home_ads.banner')
                    ->label('Flash Sale')
                    ->stacked()
                    ->circular()
                    ->size(30),
                TextColumn::make('home_footer')
                    ->formatStateUsing(function ($state) {
                        return $state;
                    })
                    ->html(true)
                    ->label('Footer')
                    ->width(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
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
            'index' => Pages\ListHomeCms::route('/'),
            'create' => Pages\CreateHomeCms::route('/create'),
            'edit' => Pages\EditHomeCms::route('/{record}/edit'),
        ];
    }
}
