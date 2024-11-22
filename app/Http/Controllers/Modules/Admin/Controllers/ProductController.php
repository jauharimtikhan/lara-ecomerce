<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Components\MediaPicker;

use Illuminate\Support\Str;
use function Modules\Frontend\Helpers\to_json;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::pages.produk.index');
    }

    public function getAllData()
    {
        $data = Product::with(['category', 'subcategory', 'gambarThumbnail'])->get()
            ->map(function ($record, $index) {
                return [
                    'id' => $record->id,
                    'name' => $record->name,
                    'category' => $record->category->name,
                    'subcategory' => $record->subcategory->name,
                    'price' => $record->price,
                    'stock' => $record->stock,
                    'weight' => $record->weight,
                    'gambar_produk' => $record->gambarThumbnail->url,
                    'no' => $index + 1
                ];
            });
        return to_json([
            'data' => $data,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::with('category')->get();
        return view('admin::pages.produk.create', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'componentGambarProduk' => 'admin-component::mediapicker'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kategori_produk' => 'required',
            'sub_kategori_produk' => 'required',
            'harga_produk' => 'required',
            'berat_produk' => 'required',
            'stok_produk' => 'required',
            'size_produk' => 'required',
            'warna_produk' => 'required',
            'is_active_produk' => 'required',
            'is_featured_produk' => 'required',
            'deskripsi_produk' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->gambar_produk === "[]") {
                $validator->errors()->add('gambar_produk', 'Gambar produk harus diisi');
            }
            return to_json([
                'errors' => $validator->getMessageBag()
            ], 422);
        }
        try {
            Product::create([
                'name' => $request->nama_produk,
                'slug' => Str::slug($request->nama_produk),
                'category_id' => $request->kategori_produk,
                'sub_category_id' => $request->sub_kategori_produk,
                'price' => $this->clearStringRupiah($request->harga_produk),
                'weight' => $request->berat_produk,
                'stock' => $request->stok_produk,
                'size' => $request->size_produk,
                'color' => $request->warna_produk,
                'is_active' => $request->is_active_produk,
                'is_featured' => $request->is_featured_produk,
                'description' => $request->deskripsi_produk,
                'thumbnail' => $this->clearUnscapedCharacter($request->gambar_produk),
                'product_galleries' => $this->clearUnscapedCharacter($request->galleri_produk) == "" ? null : $this->clearUnscapedCharacter($request->galleri_produk),
                'user_id' => Auth::user()->id
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil menambahkan produk!'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'errors' => $th->getMessage(),
                'message' => 'Gagal menambahkan produk!'
            ], 500);
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'subcategory', 'gambarThumbnail'])->findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::with('category')->get();
        return view('admin::pages.produk.edit', [
            'product' => $product,
            'componentGambarProduk' => 'admin-component::mediapicker',
            'categories' => $categories,
            'subcategories' => $subcategories,
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
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kategori_produk' => 'required',
            'sub_kategori_produk' => 'required',
            'harga_produk' => 'required',
            'berat_produk' => 'required',
            'stok_produk' => 'required',
            'size_produk' => 'required',
            'warna_produk' => 'required',
            'is_active_produk' => 'required',
            'is_featured_produk' => 'required',
            'deskripsi_produk' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->gambar_produk === "[]") {
                $validator->errors()->add('gambar_produk', 'Gambar produk harus diisi');
            }
            return to_json([
                'errors' => $validator->getMessageBag()
            ], 422);
        }
        try {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->nama_produk,
                'slug' => Str::slug($request->nama_produk),
                'category_id' => $request->kategori_produk,
                'sub_category_id' => $request->sub_kategori_produk,
                'price' => $this->clearStringRupiah($request->harga_produk),
                'weight' => $request->berat_produk,
                'stock' => $request->stok_produk,
                'size' => $request->size_produk,
                'color' => $request->warna_produk,
                'is_active' => $request->is_active_produk,
                'is_featured' => $request->is_featured_produk,
                'description' => $request->deskripsi_produk,
                'thumbnail' => $this->clearUnscapedCharacter($request->gambar_produk),
                'product_galleries' => $this->clearUnscapedCharacter($request->galleri_produk) == "" ? null : $this->clearUnscapedCharacter($request->galleri_produk),
                'user_id' => Auth::user()->id
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate produk!'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'errors' => $th->getMessage(),
                'message' => 'Gagal mengupdate produk!'
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
            $product = Product::findOrFail($id);
            $product->delete();
            return to_json([
                'status' => 201,
                'message' => 'Berhasil menghapus produk!'
            ], 201);
        } catch (\Exception $th) {
            return to_json([
                'status' => 500,
                'message' => 'Gagal menghapus produk!',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    private function clearUnscapedCharacter($form)
    {
        $clear = Str::replace(["[", '"', '"', "]"], "", $form);
        $clear = explode(',', $clear);
        if (count($clear) < 2) {
            return $clear[0];
        } else {
            return $clear !== "" ? collect($clear)->toArray() : null;
        }
    }
    private function clearStringRupiah($value)
    {
        return Str::replace(['Rp. '], '', $value);
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

    public function restoreData(Request $request)
    {
        $rows = is_string($request->rows) ? explode(',', $request->rows) : $request->rows;

        $rows = array_map(function ($row) {
            return str_replace(['["', '"]', '"'], '', $row);
        }, $rows);

        if (count($rows) > 1) {
            return $this->restoreMultiple($rows);
        } else {
            return $this->restoreSingle($rows[0]);
        }
    }

    private function restoreSingle($rowId)
    {
        try {
            // Use a single query to delete multipleCategorys by their IDs
            Product::withTrashed()->find($rowId)->restore();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil mengembalikan data produk yang dihapus!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal mengembalikan data produk yang dipilih!');
        }
    }

    private function restoreMultiple($rows)
    {
        try {
            // Use a single query to delete multipleCategorys by their IDs
            Product::withTrashed()->whereIn('id', $rows)->restore();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil mengembalikan data produk yang dihapus!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal mengembalikan data produk yang dipilih!');
        }
    }

    public function bulkForceDelete(Request $request)
    {
        $rows = is_string($request->rows) ? explode(',', $request->rows) : $request->rows;

        $rows = array_map(function ($row) {
            return str_replace(['["', '"]', '"'], '', $row);
        }, $rows);
        if (count($rows) > 1) {
            return $this->forceDeletingMultiple($rows);
        } else {
            return $this->forceDeletingSingle($rows[0]);
        }
    }

    private function forceDeletingSingle($rowId)
    {
        try {
            // Use a single query to delete multipleCategorys by their IDs
            Product::withTrashed()->find($rowId)->forceDelete();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data produk yang dipilih, Secara permanen!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data produk yang dipilih!');
        }
    }

    private function forceDeletingMultiple($rows)
    {
        try {
            // Use a single query to delete multipleCategorys by their IDs
            Product::withTrashed()->whereIn('id', $rows)->forceDelete();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data produk yang dipilih, Secara permanen!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data produk yang dipilih!');
        }
    }

    private function deleteMultipleMembers(array $rows)
    {
        try {
            // Use a single query to delete multipleCategorys by their IDs
            Product::whereIn('id', $rows)->delete();

            return to_json([
                'status' => 200,
                'message' => 'Berhasil menghapus data produk yang dipilih!'
            ], 200);
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data produk yang dipilih!');
        }
    }

    private function deleteSingleMember($rowId)
    {
        try {

            // Find theCategory and delete
            $user = Product::find($rowId);

            if ($user) {
                $user->delete();
                return to_json([
                    'status' => 200,
                    'message' => 'Berhasil menghapus data produk yang dipilih!'
                ], 200);
            } else {
                return to_json([
                    'status' => 404,
                    'message' => 'Produk tidak ditemukan!'
                ], 404);
            }
        } catch (\Exception $th) {
            return $this->handleDeleteError($th, 'Gagal menghapus data produk yang dipilih!');
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

    public function search(Request $request)
    {
        $type = $request->type;
        $value = $request->value;
        switch ($type) {
            case 'nama':
                $data = Product::with(['category', 'subcategory', 'gambarThumbnail'])->where('name', 'like', '%' . $value . '%')->get();
                break;
            case 'kategori':
                $data = Product::with(['category', 'subcategory', 'gambarThumbnail'])->where('category', 'like', '%' . $value . '%')->get();
                break;
            case 'tanggal':
                $data = Product::with(['category', 'subcategory', 'gambarThumbnail'])->where('created_at', 'like', '%' . $value . '%')->get();
                break;
            case 'data_trashed':
                $data = Product::onlyTrashed()->get();
                break;
            default:
                $data = Product::with(['category', 'subcategory', 'gambarThumbnail'])->where($type, 'like', '%' . $value . '%')->get();
                break;
        }
        $result = $data->map(function ($record, $index) {
            return [
                'id' => $record->id,
                'name' => $record->name,
                'category' => $record->category->name,
                'subcategory' => $record->subcategory->name,
                'price' => $record->price,
                'stock' => $record->stock,
                'weight' => $record->weight,
                'gambar_produk' => $record->gambarThumbnail->url,
                'no' => $index + 1
            ];
        });
        return to_json([
            'data' => $result
        ], 200);
    }
}
