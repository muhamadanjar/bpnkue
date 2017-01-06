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
						@foreach($i7['hasil'] as $i7_k => $i7_v)
						<tr>
							<td>{{ $i7_v['frekuensi'] }}</td>
							<td>{{ $i7_v['presentase'] }} %</td>
                            

						</tr>
						@endforeach

					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_i7"></div>
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
							<td>{{ $i9_v['presentase'] }} %</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_i9"></div>
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
							<td>{{ $i10_v['presentase'] }} %</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_i10"></div>
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
							<td>{{ $i12_v['presentase'] }} %</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_i12"></div>
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
							<td>{{ $i13_v['presentase'] }} %</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_i13"></div>
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
							<td>{{ $pangan_v['presentase'] }} %</td>

						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div id="chart_pangan"></div>
        </div>
    </div>

    <!--Bagian 3-->

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Apakah Saudara sudah pernah mendapatkan informasi mengenai Standar Nasional Indonesia (SNI)?</div>
                <div class="panel-body">
                    <table class="table">
                        
                        <tr>
                            <th>Frekuensi</th>
                            <th>Presentasi</th>

                        </tr>
                        @foreach($iii_1 as $iii_1_k => $iii_1_v)
                        <tr>
                            <td>{{ $iii_1_v['frekuensi'] }}</td>
                            <td>{{ $iii_1_v['presentase'] }}</td>

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="chart_iii_1"></div>
        </div>
    </div>
	
	
</div>

<script type="text/javascript">
$(function () {
    Highcharts.chart('chart_i7', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: ['1-4', '5-19', '20-99', 'Lebih dari 100']
        },
        title: {
            text: 'I7'  
        },
        series: [{
            data: [<?=implode(',', $i7['data'])?>]        
        }],
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i9', {
        chart: {
        	type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        
        title: {
            text: 'I9'  
        },
        series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]        
        }],
        credits: {
            enabled:false,
        }
    });

    
});
</script>
@stop