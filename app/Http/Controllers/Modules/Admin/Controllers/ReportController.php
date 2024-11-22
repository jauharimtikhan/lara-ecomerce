<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

use function Modules\Frontend\Helpers\to_json;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::pages.laporan.index');
    }

    public function getAllDAta()
    {
        try {
            $report = Transaction::with('userDetail', 'user')
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($record, $index) {
                    return [
                        'no' => $index + 1,
                        'id' => $record->id,
                        'name' => $record->user->name,
                        'status' => $record->status,
                        'total_transaksi' => $record->totalHarga(),
                    ];
                });

            return to_json($report, 200);
        } catch (\Exception $th) {
            return to_json($th->getMessage(), 500);
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
