<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCms;
use Illuminate\Http\Request;

use function Modules\Frontend\Helpers\to_json;

class TampilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = HomeCms::find('9d600c3a-f0dc-4779-a22d-f897d3efde98');
        return view('admin::pages.tampilan.index', [
            'banner' => $datas->banner(),
            'kategoris' => $datas,
            'categories' => Category::all()
        ]);
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
        //
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
        $datas =  HomeCms::find('9d600c3a-f0dc-4779-a22d-f897d3efde98');
        if ($id == 'banner') {
            $datas->update([
                'home_banner' => $this->clearUnscapedCharacter($request->input('banner')),
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate banner'
            ], 201);
        } elseif ($id == 'kategori') {
            $datas->update([
                'home_category' => $this->clearUnscapedCharacter($request->kategori),
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate kategori'
            ], 201);
        } elseif ($id == 'flash_sale') {
            $datas->update([
                'home_ads' => $request->input('input-flash_sale'),
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate flash sale'
            ], 201);
        } else {
            $datas->update([
                'home_footer' => $request->input('input-footer'),
            ]);
            return to_json([
                'status' => 201,
                'message' => 'Berhasil mengupdate footer'
            ], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function clearUnscapedCharacter($rows)
    {
        $rows = is_string($rows) ? explode(',', $rows) : $rows;

        $rows = array_map(function ($row) {
            return str_replace(['["', '"]', '"'], '', $row);
        }, $rows);

        return $rows;
    }
}
