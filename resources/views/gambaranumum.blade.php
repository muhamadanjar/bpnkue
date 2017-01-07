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
							<td><b><i>{{ $i7['kategori'][$i7_k] }}</i></b></td>
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
                            <th>#</th>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i9['hasil'] as $i9_k => $i9_v)
						<tr>
                            <td><b><i>{{ $i9['kategori'][$i9_k] }}</i></b></td>
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
						@foreach($i10['hasil'] as $i10_k => $i10_v)
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
							<th>#</th>
                            <th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i12['hasil'] as $i12_k => $i12_v)
						<tr>
                            <td><b><i>{{ $i12['kategori'][$i12_k] }}</i></b></td>
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
							<th>#</th>
                            <th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($i13['hasil'] as $i13_k => $i13_v)
						<tr>
                            <td><b><i>{{ $i13['kategori'][$i13_k] }}</i></b></td>
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
                            <th>#</th>
							<th>Frekuensi</th>
							<th>Presentasi</th>

						</tr>
						@foreach($pangan['hasil'] as $pangan_k => $pangan_v)
						<tr>
                            <td><b><i>{{ $pangan['kategori'][$pangan_k] }}</i></b></td>
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
            categories: ['Sudah','Belum']
        },

        title: {
            text: 'I9'  
        },
        series: [{
            data: <?=json_encode($i9['data'],JSON_NUMERIC_CHECK)?>        
        }],
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i10', {
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
            categories: ['TDP', 'UIU', 'Lainnya']
        },
        title: {
            text: 'I10'  
        },
        series: [{
            data: [<?=implode(',', $i10['data'])?>]        
        }],
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i12', {
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
            categories: ['Sudah','Belum']
        },

        title: {
            text: 'I12'  
        },
        series: [{
            data: <?=json_encode($i12['data'],JSON_NUMERIC_CHECK)?>        
        }],
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i13', {
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
            categories: ['Belum','Sudah']
        },

        title: {
            text: 'I13'  
        },
        series: [{
            data: <?=json_encode($i13['data'],JSON_NUMERIC_CHECK)?>        
        }],
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_pangan', {
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
            categories: ['Pangaan','Non Pangan']
        },

        title: {
            text: 'Pangan'  
        },
        series: [{
            data: <?=json_encode($pangan['data'],JSON_NUMERIC_CHECK)?>        
        }],
        credits: {
            enabled:false,
        }
    });
    
});
</script>
@stop