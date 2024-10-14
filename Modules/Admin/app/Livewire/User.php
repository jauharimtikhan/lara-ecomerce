<?php

namespace Modules\Admin\App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Modules\Admin\Helpers\AbstractAdminClass;
use App\Models\User as UserModels;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\View\Components\Button;

class User extends AbstractAdminClass implements HasForms, HasTable
{
    use InteractsWithTable, InteractsWithForms;
    protected static array|string $middleware = ['auth', 'role:admin|super_admin'];
    protected static string $navigationIcon = 'heroicon-s-user-circle';
    protected static string $navigationLabel = 'User';
    protected static bool $headerAction = false;
    protected static ?string $heading = 'Pengguna';
    public ?array $data = [];

    public function render()
    {
        return view('admin::pages.user');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(UserModels::query())
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('created_at')
                    ->label('Terdaftar Pada')
                    ->date('D, d/M/Y')
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                    ->label('Edit')
                    ->color('warning')
                    ->form([
                        TextInput::make('name')
                            ->label('Nama Pengguna')
                            ->placeholder('Masukan Nama Pengguna')
                            ->rules('required'),
                        TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Masukan Email')
                            ->rules('required'),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->placeholder('••••••••')
                            ->rules('required')
                    ])
                    ->modalHeading('Edit User')
                    ->modalSubmitActionLabel('Update'),
                DeleteAction::make('delete')
                    ->label('Hapus')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function mount()
    {
        //
    }

    protected function getForms(): array
    {
        return [
            'createUser'
        ];
    }

    public function createUser(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama Pengguna')
                ->placeholder('Masukan Nama Pengguna')
                ->rules('required'),
            TextInput::make('email')
                ->label('Email')
                ->placeholder('Masukan Email')
                ->rules('required'),
            TextInput::make('password')
                ->label('Password')
                ->password()
                ->revealable()
                ->placeholder('••••••••')
                ->rules('required'),
        ])
            ->statePath('data')
            ->model(UserModels::class);
    }

    public function quickAction()
    {
        $button = Button::make('create')
            ->label('Buat User Baru')
            ->color('primary')
            ->attributes([
                'data-modal-toggle' => 'createUserModal',
                'data-modal-target' => 'createUserModal',
            ]);
        return $button->toHtml();
    }

    public function storeUser()
    {
        try {
            UserModels::create([
                'name' => $this->createUser->getState()['name'],
                'email' => $this->createUser->getState()['email'],
                'password' => Hash::make($this->createUser->getState()['password']),
            ]);

            Notification::make()
                ->title('Berhasil Membuat User Baru!')
                ->success()
                ->send();
            $this->dispatch('userCreated');
        } catch (\Exception $th) {
            Notification::make()
                ->title('Gagal Membuat User Baru!')
                ->danger()
                ->send();

            $this->dispatch('userCreated');
        }
    }

    public function pages(): array
    {
        return [
            'index' => User::class
        ];
    }
}
