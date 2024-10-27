<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    public function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->action('save')
                ->label(trans('curator::views.panel.edit_save')),
            Action::make('preview')
                ->color('gray')
                ->url($this->record->url, shouldOpenInNewTab: true)
                ->label(trans('curator::views.panel.view')),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $state = $this->getForm('form')->getRawState();

        if ($state['file'] !== null) {
            $livewire = $this->getForm('form')->getLivewire();
            $statePath = $this->getForm('form')->getStatePath();

            data_set($livewire, $statePath . '.file', null);
        }
    }
}
