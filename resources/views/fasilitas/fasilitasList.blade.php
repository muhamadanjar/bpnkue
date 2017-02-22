@extends('layouts.adminlte')
@section('title','Data &rsaquo; Fasilitas')
@section('content')
	
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              	<h3 class="box-title">Sebaran Fasilitas </h3>

	            <div class="box-tools">
	            	<form method="get">
	            		{{ csrf_field() }}
	            		<div class="input-group input-group-sm" style="width: 150px;">
		                  <input type="text" name="txtsearch" class="form-control pull-right" placeholder="Search" value="{{ $_GET['txtsearch']}}">

		                  <div class="input-group-btn">
		                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
		                  </div>
		                </div>

	            	</form>
	                
	            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

              <table class="table table-hover">
                <tbody>
	                <tr>
	                  <th>ID</th>
	                  <th>Nama Fasilitas</th>
	                  <th>Nama Jalan</th>
	                  <th>Jenis Fasilitas</th>

	                </tr>
	                
	                
              	</tbody>
              </table>
            </div>

            <div class="box-footer clearfix">            	
              	<a class="btn btn-info"><b>{{ session('jumlah_record') }}</b></a>
            	
             	

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
@endsection