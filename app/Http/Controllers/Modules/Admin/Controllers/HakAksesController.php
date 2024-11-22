<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Modules\Frontend\Helpers\to_json;

class HakAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('admin::pages.hak_akses.index', [
            'roleWithPermissions' => $roles,
            'permissions' => Permission::all()
        ]);
    }

    public function getAllData()
    {
        try {
            $roles = Role::with('permissions')->get();

            $groupedRoles = $roles->map(function ($role) {
                return [
                    'role' => $role->name,
                    'permissions' => $role->permissions()->pluck('name', 'uuid')->toArray(),
                ];
            });
            return to_json([
                'data_role' => $roles,
                'data_permission' => $groupedRoles,
            ], 200);
        } catch (\Exception $th) {
            return to_json([
                'data_role' => [],
                'error' => $th->getMessage()
            ], 500);
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = Role::findOrFail($request->input('role_id'));
            $permission = Permission::findOrFail($request->input('permission_id'));
            $checked = $request->input('checked');
            // dd($checked);
            switch ($checked) {
                case 'true':
                    $role->permissions()->attach($permission);
                    break;
                default:
                    $role->permissions()->detach($permission);
                    break;
            }

            return response()->json(['status' => true, 'message' => 'Berhasil mengubah hak akses'], 200);
        } catch (\Exception $th) {
            return response()->json(['status' => false, 'message' => 'Gagal mengubah hak akses', 'errors' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
