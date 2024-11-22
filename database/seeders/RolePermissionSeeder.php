<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routeCollection = Route::getRoutes()->get();

        foreach ($routeCollection as $item) {
            $name = $item->action;
            if (!empty($name['as']) && $name['as'] != 'home') {
                $permission = $name['as'];
                $permission = trim(strtolower($permission));
                $permission = str_replace('.', '_', $permission);
                Permission::create([
                    'name' => $permission
                ]);


                $roleAdmin = Role::findByName('super_admin');

                $roleAdmin->givePermissionTo($permission);
                // $this->info('Berhasil Membuat Hak Akses : ' . $permission . " dengan role super_admin");
            }
        }
    }
}
