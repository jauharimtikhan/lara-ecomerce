<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RAisedSales extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penjualan Perbulan';
    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $bulanIndonesia = [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Agu',
            '09' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
        ];
        $monthlyAmounts = DB::table('transactions')
            ->select(
                DB::raw('SUM(total_price) as total_amount'),
                DB::raw('COUNT(id) as total_terjual'),
                DB::raw("strftime('%m', created_at) as month")
            )
            ->groupBy(DB::raw("strftime('%m', created_at)"))
            ->orderBy(DB::raw("strftime('%m', created_at)"))
            ->where('status', 'settlement')
            ->get();
        $monthlyAmounts = $monthlyAmounts->mapWithKeys(function ($item) use ($bulanIndonesia) {
            return [$item->month => [
                'total_amount' => $item->total_amount,
                'bulan_indonesia' => $bulanIndonesia[$item->month],
                'total_terjual' => $item->total_terjual
            ]];
        });

        // Menambahkan bulan yang tidak memiliki data
        $allMonths = collect($bulanIndonesia)->map(function ($namaBulan, $kodeBulan) use ($monthlyAmounts) {
            return [
                'bulan_indonesia' => $namaBulan,
                'total_amount' => $monthlyAmounts[$kodeBulan]['total_amount'] ?? 0,
                'total_terjual' => $monthlyAmounts[$kodeBulan]['total_terjual'] ?? 0
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan',
                    'data' => $allMonths->pluck('total_terjual')->toArray(),
                ]
            ],
            'labels' => $allMonths->pluck('bulan_indonesia')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getMaxHeight(): ?string
    {
        return '50';
    }
}
