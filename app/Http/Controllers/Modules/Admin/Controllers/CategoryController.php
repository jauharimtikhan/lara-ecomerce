<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CuratorMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Modules\Frontend\Helpers\to_json;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::pages.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medias = CuratorMedia::all();
        return view('admin::pages.kategori.create', [
            'mediaItems' => $medias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'media' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }
        $rows = is_string($request->media) ? explode(',', $request->media) : $request->media;

        // replace character "[", "]" with empty string
        $rows = array_map(function ($row) {
            return str_replace(['["', '"]', '"'], '', $row);
        }, $rows);
        try {
            Category::create([
                'name' => $request->name,
                'media_id' => $rows[0]
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil menambahkan kategori baru!'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal menambahkan kategori!',
                'errors' => $th->getMessage()
            ], 500);
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
        $category = Category::with('media')->find($id);
        return to_json([
            'data' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rows = is_string($request->mediaedit) ? explode(',', $request->mediaedit) : $request->mediaedit;

        // replace character "[", "]" with empty string
        $rows = array_map(function ($row) {
            return str_replace(['["', '"]', '"'], '', $row);
        }, $rows);
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->namedit,
                'media_id' => $rows[0]
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate data kategori!'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal mengupdate data kategori!',
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
            $category = Category::findOrFail($id);
            $category->delete();
            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data kategori!'
            ], 200);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal menghapus data kategori!',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function getAllData()
    {
        $categories = Category::with('media')->get()
            ->map(function ($record, $index) {
                return [
                    'id' => $record->id,
                    'name' => $record->name,
                    'media' => $record->media()->first()->url,
                    'no' => $index + 1
                ];
            });
        return to_json([
            'data' => $categories,
        ], 200);
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
            // Use a single query to delete multipleCategorys by their IDs
            Category::whereIn('id', $rows)->delete();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data kategori yang dipilih!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data kategori yang dipilih!');
        }
    }

    private function deleteSingleMember($rowId)
    {
        try {

            // Find theCategory and delete
            $user = Category::find($rowId);

            if ($user) {
                $user->delete();
                return to_json([
                    'status' => 200,
                    'message' => 'Berhasil menghapus data kategori yang dipilih!'
                ], 200);
            } else {
                return to_json([
                    'status' => 404,
                    'message' => 'Kategori tidak ditemukan!'
                ], 404);
            }
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data kategori yang dipilih!');
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
