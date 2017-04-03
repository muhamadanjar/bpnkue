@extends('layouts.adminlte')

@section('content')
<div class="box box-default">
	<div class="box-header with-border">
			<h6 class="box-title"><i class="icon-file"></i> POI</h6>
		<a href="{{ url('poi/tambah') }}">
			<button class="pull-right btn btn-sm btn-primary" type="button">
				<i class="fa fa-plus-circle"></i> Tambah
			</button>
		</a>
	</div>
	<div class="box-body">
		<div class="datatable">
			<table class="table table-striped table-bordered">
				<thead>
				    <tr>
				        <th>daerah_irigasi</th>
				        <th>bendung</th>
				        <th>jaringan_irigasi</th>
				        <th>saluran_primer</th>
				        <th>#</th>
				    </tr>
				</thead>
				<tbody>
					@foreach($poi as $key => $p)
					
					@endforeach
				</tbody>
			</table>           
		</div>
	</div>
</div>	
@stop