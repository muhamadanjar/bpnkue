@extends('layouts.adminlte')
@section('content')
	<?php
		if ($aksi == 'edit') {
			$id = $jalan->id;
			$kode_ruas = $jalan->kode_ruas;
			$nama = $jalan->nama;
			$panjang = $jalan->panjang;
			$lebar = $jalan->lebar;
			$status = $jalan->status;
			$keterangan = $jalan->keterangan; 
		}else{
			$id = '';
            $kode_ruas = '';
            $nama = '';
            $panjang = '';
            $lebar = '';
            $status = '';
            $keterangan = ''; 
		}
	?>
    <form action="{{ url('admin/jalan/fungsi/post') }}" method="post" >
	    <div class="panel panel-default">
		
			<div class="panel-heading">
			 	<h6 class="panel-title"><i class="icon-file"></i> Fungsi Jalan</h6>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" value="{{ $id }}">

			<div class="panel-body">             
				<div class="row">
		            <div class="col-md-12">
		            	<div class="form-group">
		            		<label for="kode_ruas" class="col-md-2 control-label-kiri">Kode Ruas</label>
		            		<div class="col-md-3">
		            			<input name="kode_ruas" class="form-control" value="{{ $kode_ruas }}" />
		            		</div>
		            	</div>
		            </div>

		            <div class="col-md-12">
		            	<div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Nama</label>
                            <div class="col-md-8">
                                <div class="input-group">
									<input name="nama" id="nama" class="form-control" value="{{ $nama }}" />
								</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="panjang" class="col-md-2 control-label-kiri">Panjang</label>
                            <div class="col-md-2">
                                <input name="panjang" class="form-control" value="{{ $panjang }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="lebar" class="col-md-2 control-label-kiri">Lebar</label>
                            <div class="col-md-2">
                                <input name="lebar" class="form-control" value="{{ $lebar }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status" class="col-md-2 control-label-kiri">Status</label>
                            <div class="col-md-5">
                        		<select name="status" class="form-control">
		                            <option value="-">------</option>
		                           	<option value="jalan_kab_kolektor" @if($status =='jalan_kab_kolektor') selected="selected" @endif>jalan_kab_kolektor</option>
		                            <option value="jalan_kab_primer" @if($status =='jalan_kab_primer') selected="selected" @endif>jalan_kab_primer</option>
		                           
		                        </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="keterangan" class="col-md-2 control-label-kiri">Keterangan</label>
                            <div class="col-md-1">
                               <input name="keterangan" class="form-control" value="{{ $keterangan }}" />
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="form-actions text-right">
                            <div class="col-md-11 col-md-offset-1">
                                <a href="{{ url('admin/jalan/fungsi') }}" class="btn btn-default">Reset</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

		            
		        </div>
	        </div>
		</div>	
	</form>
           
@endsection


				
	


