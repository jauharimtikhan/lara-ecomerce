<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Awcodes\Curator\Actions\MultiUploadAction;
use Awcodes\Curator\CuratorPlugin;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMedia extends ListRecords
{
    public string $layoutView;
    protected static string $resource = MediaResource::class;

    public function mount(): void
    {
        parent::mount();
        $this->layoutView = 'grid';
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('toggle-table-view')
                ->color('gray')
                ->label(function (): string {
                    return $this->layoutView === 'grid'
                        ? trans('curator::tables.actions.toggle_table_list')
                        : trans('curator::tables.actions.toggle_table_grid');
                })
                ->icon(function (): string {
                    return $this->layoutView === 'grid'
                        ? 'heroicon-s-queue-list'
                        : 'heroicon-s-squares-2x2';
                })
                ->action(function ($livewire): void {
                    $livewire->dispatch('changeLayoutView');
                }),
            MultiUploadAction::make(),
            CreateAction::make()
                ->label(fn(): string => trans('filament-actions::create.single.label', ['label' => 'Media'])),
        ];
    }
}
