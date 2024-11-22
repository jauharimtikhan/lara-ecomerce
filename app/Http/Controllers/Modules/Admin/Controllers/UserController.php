<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use function Modules\Frontend\Helpers\to_json;

class UserController extends Controller
{

    public function getAllData()
    {
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['admin', 'super_admin']);
            })
            ->get()
            ->map(function ($record, $index) {
                return [
                    'id' => $record->id,
                    'name' => $record->name,
                    'email' => $record->email,
                    'role' => $record->roles->pluck('name'),
                    'created_at' => Carbon::parse($record->created_at)->isoFormat('dddd, D-MM-Y HH:mm:ss'),
                    'no' => $index + 1
                ];
            });

        return to_json([
            'data' => $users
        ], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin::pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin::pages.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return to_json([
                'status' => 422,
                'errors' => $validator->getMessageBag()
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $roles = Role::where('uuid', $request->role)->first();
            $user->assignRole($roles->name);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil membuat member'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal membuat member'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
        $user = User::with('roles')->find($id);
        $roles = Role::all();
        return view('admin::pages.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
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

        $user = User::findOrFail($id);

        try {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::check($request->password, $user->password) ? $request->password : Hash::make($request->password)
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate data member'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal mengupdate data member',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::where('id', $id)->first();
            $user->delete();
            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data member!'
            ], 200);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal menghapus data member!',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        // Convert rows to an array if it's a string
        $rows = is_string($request->rows) ? explode(',', $request->rows) : $request->rows;

        // replace character "[", "]" with empty string
        $rows = array_map(function ($row) {
            return str_replace(['["', '"]', '"'], '', $row);
        }, $rows);

        // Check if there are multiple rows to delete
        if (count($rows) > 1) {
            return $this->deleteMultipleMembers($rows);
        } else {
            return $this->deleteSingleMember($rows[0]);
        }
    }

    private function deleteMultipleMembers(array $rows)
    {
        try {
            // Use a single query to delete multiple users by their IDs
            User::whereIn('id', $rows)->delete();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data member yang dipilih!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data member yang dipilih!');
        }
    }

    private function deleteSingleMember($rowId)
    {
        try {

            // Find the user and delete
            $user = User::find($rowId);

            if ($user) {
                $user->delete();
                return to_json([
                    'status' => 200,
                    'message' => 'Berhasil menghapus data member yang dipilih!'
                ], 200);
            } else {
                return to_json([
                    'status' => 404,
                    'message' => 'Member tidak ditemukan!'
                ], 404);
            }
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data member yang dipilih!');
        }
    }

    private function handleDeleteError(\Exception $th, $message)
    {
        return to_json([
            'status' => 500,
            'message' => $message,
            'errors' => $th->getMessage()
        ], 500);
    }
}
