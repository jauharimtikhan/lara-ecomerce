<?php

namespace Modules\Admin\App\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Helpers\AbstractAdminClass;
use Modules\Admin\Helpers\Concerns\HasQuickAction;
use Modules\Admin\View\Components\Button;

class HakAkses extends AbstractAdminClass implements HasForms
{
    use HasQuickAction, InteractsWithForms;
    protected static $middleware = ['auth'];
    protected static string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string $navigationLabel = 'Settings';
    protected static bool $headerAction = false;
    protected static ?string $heading = 'Hak Akses';
    public ?array $dataCreateRoles = [];
    public ?bool $showTabs = false;
    public $defaultShowTabs = 'super_admin';
    public ?array $dataPermissions = [];

    public ?array $dataUpdateRole = [];

    public function setDefaultShowTabs($name)
    {
        $this->defaultShowTabs = $name;
    }

    public function setShowTabs()
    {
        $this->showTabs = true;
    }
    public function mount()
    {
        $this->createForm->fill(['guard_name' => 'web']);
        $this->updateRole->fill(['guard_name' => 'web']);
    }


    public function updatePermission($params)
    {
        try {
            $role = Role::findOrFail($params['roleId']);
            $permission = Permission::findOrFail($params['permissionId']);
            $checked = $params['isChecked'];
            if ($checked) {
                $role->permissions()->attach($permission);
            } else {
                $role->permissions()->detach($permission);
            }
            Notification::make()
                ->title('Berhasil Mengupdate Hak Akses!')
                ->success()
                ->send();
            $this->dispatch('permission-notification');
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Gagal Mengupdate Hak Akses!')
                ->danger()
                ->send();
            $this->dispatch('permission-notification');
        }
    }

    public function render()
    {
        $roleWithPermissions = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin::pages.hak-akses', [
            'roles' => Role::all(),
            'roleWithPermissions' => $roleWithPermissions,
            'permissions' => $permissions
        ]);
    }

    public function quickAction()
    {

        $button = Button::make('create')
            ->label('Buat Hak Akses')
            ->wireTarget('create')
            ->type('button')
            ->attributes([
                'data-modal-toggle' => 'create-permission',
                'data-modal-target' => 'create-permission',
            ]);
        return $button->toHtml();
    }
    protected function getForms(): array
    {
        return [
            'createForm',
            'updateRole'
        ];
    }
    public function createForm(Form $form): Form
    {
        return $form->schema([
            Grid::make()->schema([
                TextInput::make('name')
                    ->label('Nama Hak Akses')
                    ->placeholder('Masukan Nama Hak Akses')
                    ->rules('required')
                    ->required(),
                Select::make('guard_name')
                    ->label('Guard')
                    ->options([
                        'web' => 'Web',
                        'api' => 'API',
                    ])
                    ->native(false)
                    ->default('web'),
            ])->columns(1),
        ])
            ->statePath('dataCreateRoles')
            ->model(Role::class);
    }

    public function edit($id)
    {
        $this->dispatch('call-modal-update');
        $role = Role::find($id);
        $this->updateRole->fill([
            'name' => $role->name,
            'guard_name' => $role->guard_name,
            'uuid' => $role->uuid
        ]);
    }

    public function create()
    {

        Role::create($this->createForm->getState());
        Notification::make()
            ->title('Berhasil Menambahkan Hak Akses Baru!')
            ->success()
            ->send();
        $this->dispatch('filament-notification');
    }

    public function generatePermission()
    {

        $routeCollection = Route::getRoutes()->get();
        foreach ($routeCollection as $item) {
            $name = $item->action;
            if (!empty($name['as'])) {
                $permission = $name['as'];
                $permission = trim(strtolower($permission));
                $permission = preg_replace('/[\s.,-]+/', '-', $permission);
                Permission::findOrCreate($permission, 'web');
            }
        }
        Notification::make()
            ->title('Berhasil Generate Hak Akses!')
            ->success()
            ->send();
    }



    public function updateRole(Form $form): Form
    {
        return $form->schema([
            Hidden::make('uuid'),
            TextInput::make('name')
                ->label('Nama Hak Akses'),
            Select::make('guard_name')
                ->options([
                    'web' => 'Web',
                    'api' => 'API',
                ])
                ->default('web')
                ->native(false)
                ->label('Guard'),
        ])
            ->statePath('dataUpdateRole')
            ->model(Role::class);
    }

    public function updateRoleForm()
    {
        try {
            $role = Role::find($this->updateRole->getState()['uuid']);
            $role->update([
                'name' => $this->updateRole->getState()['name'],
                'guard_name' => $this->updateRole->getState()['guard_name'],
            ]);

            Notification::make('updated')
                ->title('Berhasil Mengupdate Data Hak Akses')
                ->success()
                ->send();
            $this->redirect(route('admin.hakakses'), true);
        } catch (\Exception $th) {
            Notification::make('updated')
                ->title('Gagal Mengupdate Data Hak Akses')
                ->danger()
                ->send();
            $this->redirect(route('admin.hakakses'), true);
        }
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();

        Notification::make('deleted')
            ->title('Berhasil Menghapus Hak Akses')
            ->success()
            ->send();
        $this->redirect(route('admin.hakakses'), true);
    }

    public function pages(): array
    {
        return [
            'index' => HakAkses::class
        ];
    }
}
