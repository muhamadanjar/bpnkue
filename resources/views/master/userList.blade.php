@extends('layouts.adminlte')
@section('page-header')
	<div class="page-header">
		<div class="page-title">
			<h3>User <small>List user</small></h3>
		</div>

		<div id="reportrange" class="range">
			<div class="visible-xs header-element-toggle">
				<a class="btn btn-primary btn-icon"><i class="icon-calendar"></i></a>
			</div>
			<div class="date-range"></div>
			<span class="label label-danger">9</span>
		</div>
	</div>
@endsection

@section('breadcrumb')
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Master</a></li>
		<li class="active">User</li>
	</ul>
	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
@endsection
@section('content')
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-user"></i> Daftar User</h6>
					<a href="{{ url('admin/user/tambah') }}" class="pull-right btn btn-xs btn-primary">
						<i class="icon-plus-circle2"></i> Tambah</a>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Nama</th>
							<th>Role</th>
						</tr>
						
						@foreach($users as $key => $v)
                        <?php $class_active = ($v->isactive==0) ? 'btn-warning':'' ?>
						<tr>
							<td>{{ $v->username }}</td>
							<td>{{ $v->email }}</td>
							<td>{{ $v->name }}</td>
							<td>
								<div class="btn-group">
					                <button data-toggle="dropdown" class="btn {{ $class_active }} btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
									<ul class="dropdown-menu icons-right dropdown-menu-right">
										<li><a href="{{ url('admin/user/ubah', ['id' => $v->id]) }}"><i class="icon-quill2"></i> Ubah</a></li>
										<li data-form="#frm-{{$v->id}}" 
											data-title="Hapus {{ $v->id }}" 
											data-message="Apa anda yakin menghapus {{ $v->username }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-bell"></i> Hapus</a>
										</li>
										<form action="{{ url('admin/user/hapus', array($v->id) ) }}" method="post" style="display:none" id="frm-{{$v->id}}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										</form>
                                        <li data-form="#frmaktif-{{$v->id}}" 
											data-title="Aktif {{ $v->id }}" 
											data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $v->username }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-bell"></i> Aktif / Non Aktif</a>
										</li>
										<form action="{{ url('admin/user/aktifnonaktif', array($v->id) ) }}" method="get" style="display:none" id="frmaktif-{{$v->id}}"></form>					
									</ul>
				                </div>
							</td>
						</tr>
						@endforeach
					</table>
                    
                    *) Kuning = Non AKtif || Abu abu = Aktif
				</div>
			</div>
		</div>
	</div>
@endsection