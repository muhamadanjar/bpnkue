@extends('layouts.adminlte')

@section('content')
<form role="form" enctype="multipart/form-data" method="post">
<div class="box box-default">
    <div class="box-header with-border"><h6 class="box-title"><i class="icon-file"></i> Ubah URL</h6></div>
    <div class="box-body">             
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Semua data harus diisi.
                </div>
            @else
                        
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="search" class="col-md-2 control-label-reverse">Cari URL</label>
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" placeholder="Cari Server host" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="replace" class="col-md-2 control-label-reverse">Ganti URL</label>
                    <div class="col-md-10">
                        <input type="text" name="replace" class="form-control" placeholder="Ganti Server host">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-11 col-md-offset-1">
                        <a href="#" class="btn btn-default">Reset</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            
        </div>
    </div>
</div>
</form>
@stop