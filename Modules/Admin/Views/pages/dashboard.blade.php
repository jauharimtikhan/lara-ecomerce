@extends('admin::layout.main', ['title' => 'Dashboard'])
@section('content')
    <div class="mt-3 content-header">
        <h1>Dashboard</h1>
    </div>
    <div class="card card-body rounded-10">
        <div class="d-flex justify-content-center" id="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <div id="transaction-chart" style="width:100%; height:400px;"></div>
    </div>
@endsection

@push('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mnDashboard').addClass('active');
            $.getJSON($.route('admin.dashboard.create'), function(data) {
                $('#loader').remove();
                const dates = data.map(item => item.date);
                const totals = data.map(item => parseFloat(item.total));

                Highcharts.chart('transaction-chart', {
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: 'Data Transaksi'
                    },
                    xAxis: {
                        categories: dates,
                        title: {
                            text: 'Tanggal'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Total Transaksi'
                        }
                    },
                    series: [{
                        name: 'Total',
                        data: totals
                    }]
                });
            });
        });
    </script>
@endpush
