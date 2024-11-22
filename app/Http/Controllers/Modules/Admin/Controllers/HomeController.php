<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

use function Modules\Frontend\Helpers\to_json;

class HomeController extends Controller
{
    public function index()
    {

        return view('admin::pages.dashboard');
    }

    public function create()
    {
        $transactions = Transaction::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        return to_json($transactions, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Request $request, string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
