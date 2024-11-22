<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Modules\Frontend\Helpers\to_json;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view('admin::pages.sub_kategori.index', [
            'categories' => $categories
        ]);
    }

    public function getAllData()
    {
        $categories = SubCategory::with('category')->get()
            ->map(function ($record, $index) {
                return [
                    'id' => $record->id,
                    'name' => $record->name,
                    'nama_kategori' => $record->category->name,
                    'no' => $index + 1
                ];
            });
        return to_json([
            'data' => $categories,
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'nama_sub_kategori' => 'required',
            'kategori' => 'required'
        ]);

        if ($validator->fails()) {
            return to_json([
                'errors' => $validator->getMessageBag()
            ], 422);
        }

        try {
            SubCategory::create([
                'name' => $request->nama_sub_kategori,
                'category_id' => $request->kategori
            ]);

            return to_json([
                'status' => 201,
                'message' => 'Berhasil menambahkan data sub kategori!'
            ], 201);
        } catch (\Throwable $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal menambahkan data sub kategori!',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = SubCategory::where('id', $id)
                ->firstOrFail();
            return to_json([
                'status' => 200,
                'data' => $category
            ], 200);
        } catch (\Throwable $th) {
            return to_json([
                'status' => 500,
                'data' => [],
                'message' => 'Data sub kategori tidak ditemukan!',
                'errors' => $th->getMessage()
            ], 500);
        }
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
        try {
            $category = SubCategory::where('id', $id)->firstOrFail(['id', 'name', 'category_id']);
            $category->update([
                'name' => $request->name,
                'category_id' => $request->kategori
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate data sub kategori!'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal mengupdate data sub kategori!',
                'errors' => $th->getMessage()
            ], 500);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = SubCategory::where('id', $id)->first();
            $category->delete();
            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data sub kategori!'
            ], 200);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'errors' => $th->getMessage(),
                'message' => 'Gagal menghapus data sub kategori!'
            ], 500);
            //throw $th;
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
            // Use a single query to delete multipleCategorys by their IDs
            SubCategory::whereIn('id', $rows)->delete();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data sub kategori yang dipilih!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data sub kategori yang dipilih!');
        }
    }

    private function deleteSingleMember($rowId)
    {
        try {

            // Find theCategory and delete
            $user = SubCategory::find($rowId);

            if ($user) {
                $user->delete();
                return to_json([
                    'status' => 200,
                    'message' => 'Berhasil menghapus data sub kategori yang dipilih!'
                ], 200);
            } else {
                return to_json([
                    'status' => 404,
                    'message' => 'Data Sub Kategori tidak ditemukan!'
                ], 404);
            }
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data sub kategori yang dipilih!');
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
