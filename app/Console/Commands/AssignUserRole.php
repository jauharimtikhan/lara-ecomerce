<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignUserRole extends Command
{
    // Nama dan deskripsi dari command
    protected $signature = 'assign:role {user_id} {role}';
    protected $description = 'Assign a role to a user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Ambil user berdasarkan user_id dari argument command
        $user = User::find($this->argument('user_id'));

        if (!$user) {
            $this->error('User not found!');
            return;
        }

        // Ambil role berdasarkan nama role dari argument command
        $roleName = $this->argument('role');
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error('Role not found!');
            return;
        }

        // Assign role ke user
        $user->assignRole($roleName);

        $this->info("Role '{$roleName}' has been assigned to user '{$user->name}'.");
    }
}
