@extends('template.londinium')

@section('page-header')
	<div class="page-header">
		<div class="page-title">
			<h3>Fixed bavbar <small>Page example with fixed navbar</small></h3>
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
		<li><a href="{{ url() }}">Home</a></li>
		<li><a href="{{ url('admin/master/index') }}">Master</a></li>
		<li class="active">Fixed navbar</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

	<ul class="breadcrumb-buttons collapse">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search3"></i> <span>Search</span> <b class="caret"></b></a>
			<div class="popup dropdown-menu dropdown-menu-right">
				<div class="popup-header">
					<a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a>
					<span>Quick search</span>
					<a href="#" class="pull-right"><i class="icon-new-tab"></i></a>
				</div>
				<form action="#" class="breadcrumb-search">
					<input type="text" placeholder="Type and hit enter..." name="search" class="form-control autocomplete">
					<div class="row">
						<div class="col-xs-6">
							<label class="radio">
								<input type="radio" name="search-option" class="styled" checked="checked">
											Everywhere
							</label>
							<label class="radio">
								<input type="radio" name="search-option" class="styled">
											Invoices
							</label>
						</div>

						<div class="col-xs-6">
							<label class="radio">
								<input type="radio" name="search-option" class="styled">
											Users
							</label>
							<label class="radio">
								<input type="radio" name="search-option" class="styled">
											Orders
							</label>
						</div>
					</div>

					<input type="submit" class="btn btn-block btn-success" value="Search">
				</form>
			</div>
		</li>

		<li class="language dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/flags/german.png" alt=""> <span>German</span> <b class="caret"></b></a>
						<ul class="dropdown-menu dropdown-menu-right icons-right">
							<li><a href="#"><img src="images/flags/ukrainian.png" alt=""> Ukrainian</a></li>
							<li class="active"><a href="#"><img src="images/flags/english.png" alt=""> English</a></li>
							<li><a href="#"><img src="images/flags/spanish.png" alt=""> Spanish</a></li>
							<li><a href="#"><img src="images/flags/german.png" alt=""> German</a></li>
							<li><a href="#"><img src="images/flags/hungarian.png" alt=""> Hungarian</a></li>
						</ul>
		</li>
	</ul>
</div>
@endsection

@section('callout')
<div class="callout callout-info fade in">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h5>Page layout with fixed navbar</h5>
	<p>Page layout example with sticked to top navbar, fixed position.</p>
</div>
@endsection

@section('content')

<?php
$id = '';
$username = '';
$name = '';
$email = '';
$password = '';
$username_readonly = '';

if ($status == 'edit') {
	$id = $users->id;
	$username = $users->username;
	$name = $users->name;
	$email = $users->email;
	$password = $users->password;
	$oldpassword = $users->password;
	$nik = $users->nik;
	$username_readonly = 'readonly';
}

?>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-user"></i> Tambah User</h6>
					<a href="{{ url('admin/user') }}" class="pull-right btn btn-xs btn-primary">
						<i class="icon-back"></i> Kembali</a>
				
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/admin/user/add-edit') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="status" value="{{ $status }}">
						
						@if($status =='edit')
						<input type="hidden" name="id" value="{{ $id }}">

						@endif
						
						<div class="form-group">
							<label class="col-md-2 control-label">Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ $username }}" <?php echo $username_readonly ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Nama Lengkap</label>
							<div class="col-md-6">
								<input  class="form-control" name="name" type="text" value="{{ $name }}">
								
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Email</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="email" value="{{ $email}}">
							</div>
						</div>
						
						@if($status == 'edit')
						
						<input type="hidden" class="form-control" name="oldpassword" value="{{ $password }}">
							
						@endif

						<div class="form-group">
							<label class="col-md-2 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" value="{{ $password }}">
							</div>
						</div>
                      
                        
						<div class="form-group">
							<label class="col-md-2 control-label">Level</label>
							<div class="col-md-2">
								<select name="level" class="form-control">
									<option value="9">Operator</option>
								</select>
								
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Image</label>
							<div class="col-md-6">
								<input type="file" class="styled" name="image">
							</div>
						</div>
                        
                      

						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	</div>
@endsection

@section('footer')
<div class="footer clearfix">
	<div class="pull-left">&copy; 2013. Londinium Admin Template by <a href="http://themeforest.net/user/Kopyov">Eugene Kopyov</a></div>
	<div class="pull-right icons-group">
	    <a href="#"><i class="icon-screen2"></i></a>
	    <a href="#"><i class="icon-balance"></i></a>
	    <a href="#"><i class="icon-cog3"></i></a>
	</div>
</div>
@endsection
@stop