@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Jumlah Karyawan</div>
                <div class="panel-body">
                	<table class="table">
						
						<tr>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i7 as $i7_k => $i7_v)
						<tr>
							<td>{{ $i7_v['frekuensi'] }}</td>
							<td>{{ $i7_v['presentase'] }}</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_jmlkaryawan"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Apakah UMKM sudah mempunyai legalitas usaha</div>
                <div class="panel-body">
                	<table class="table">
						
						<tr>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i9 as $i9_k => $i9_v)
						<tr>
							<td>{{ $i9_v['frekuensi'] }}</td>
							<td>{{ $i9_v['presentase'] }}</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_2"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Legalitas yang Dimiliki</div>
                <div class="panel-body">
                	<table class="table">
						
						<tr>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i10 as $i10_k => $i10_v)
						<tr>
							<td>{{ $i10_v['frekuensi'] }}</td>
							<td>{{ $i10_v['presentase'] }}</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_2"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Apakah Produk yang dihasilkan sudah mempunyai Merk yang terdaftar di Kementerian Hukum dan HAM</div>
                <div class="panel-body">
                	<table class="table">
						
						<tr>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i12 as $i12_k => $i12_v)
						<tr>
							<td>{{ $i12_v['frekuensi'] }}</td>
							<td>{{ $i12_v['presentase'] }}</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_2"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Apabila produk Saudara sudah mempunyai ijin edar?</div>
                <div class="panel-body">
                	<table class="table">
						
						<tr>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i13 as $i13_k => $i13_v)
						<tr>
							<td>{{ $i13_v['frekuensi'] }}</td>
							<td>{{ $i13_v['presentase'] }}</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_2"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Jenis produk apa yang saudara hasilkan?</div>
                <div class="panel-body">
                	<table class="table">
						
						<tr>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($pangan as $pangan_k => $pangan_v)
						<tr>
							<td>{{ $pangan_v['frekuensi'] }}</td>
							<td>{{ $pangan_v['presentase'] }}</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_2"></div>
        </div>
    </div>
	
	
</div>

<script type="text/javascript">
$(function () {
    Highcharts.chart('chart_jmlkaryawan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares January, 2015 to May, 2015'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Microsoft Internet Explorer',
                y: 56.33
            }, {
                name: 'Chrome',
                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: 'Firefox',
                y: 10.38
            }, {
                name: 'Safari',
                y: 4.77
            }, {
                name: 'Opera',
                y: 0.91
            }, {
                name: 'Proprietary or Undetectable',
                y: 0.2
            }]
        }]
    });
});
</script>
@stop