@extends('layouts.adminlte')

@section('content')
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              	<h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
	                <tr>
	                  <th>ID</th>
	                  <th>Nama UMKM</th>
	                  <th>Nama Pemilik</th>
	                  <th>Alamat Perusahaan</th>
	                  <th>No HP/Telepon</th>
	                  <th>Jumlah Karyawan</th>
	                </tr>
	                @foreach($bagian_satu as $key => $value)
	                <tr>
	                  <td><a href="{{ url('kuesioner/profil',array($value->id)) }}" class="btn btn-sm btn-default btn-block"><i class="fa fa-info"></i> {{$value->id}}</a></td>
	                  <td>{{$value->i_1}}</td>
	                  <td>{{$value->i_2}}</td>
	                  <td>{{$value->i_3}}</td>
	                  <td>{{$value->i_4}}.</td>
	                  <td>{{$value->i_7}}.</td>
	                </tr>
	                @endforeach
	                
              	</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
@endsection