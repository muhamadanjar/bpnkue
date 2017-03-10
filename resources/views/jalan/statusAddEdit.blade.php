@extends('layouts.adminlte')
@section('content')
	<?php
		if ($aksi == 'edit') {
			$id = $jalan->id;
			$kode_ruas = $jalan->kode_ruas;
      $no_ruas = $jalan->no_ruas;
			$nama_ruas = $jalan->nama_ruas;
      $kecamatan = $jalan->kecamatan;
      $kelurahan = $jalan->kelurahan;
      $kondisi = $jalan->id_kondisi;
      $titik_pangkal = $jalan->titik_pangkal;
      $titik_akhir = $jalan->titik_akhir;
			$panjang_ruas = $jalan->panjang_ruas;
			$lebar_ruas = $jalan->lebar_ruas;
      $jenis_perkerasan = $jalan->jenis_perkerasan;
      $tahun_renovasi = $jalan->tahun_renovasi;
			$keterangan = $jalan->keterangan;
      $jenis_permukaan_jalan = $jalan->jenis_permukaan_jalan;
      $nilai_rci = $jalan->nilai_rci;
      $kelas = $jalan->kelas;
      $fungsi = $jalan->fungsi;
      $drainase = $jalan->drainase;
      $kondisi_drainase = $jalan->kondisi_drainase;
		}else{
			$id = '';
      $no_ruas = '';
      $kode_ruas = '';
      $nama_ruas = '';
      $kecamatan = '';
      $kelurahan = '';
      $titik_pangkal = '';
      $titik_akhir = '';
      $panjang_ruas = '';
			$lebar_ruas = '';
      $jenis_perkerasan = '';
      $tahun_renovasi = '';
      $keterangan = '';
      $kondisi = '';
      $jenis_permukaan_jalan= '';
      $nilai_rci = '';
      $kelas = '';
      $fungsi = '';
      $drainase = '';
      $kondisi_drainase = '';
		}
	?>
<form action="{{ url('admin/jalan/status/post') }}" method="post" >
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
                      <label for="kode_ruas" class="col-md-2 control-label-kiri">No Ruas</label>
                      <input name="no_ruas" id="no_ruas" class="form-control" value="{{ $no_ruas }}" />

                    </div>
                  	<div class="form-group">
      		          	<label for="kode_ruas" class="col-md-2 control-label-kiri">Kode Ruas</label>
      		          	<input name="kode_ruas" class="form-control" value="{{ $kode_ruas }}" />
      		          </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Nama Ruas</label>
                        <input name="nama_ruas" id="nama_ruas" class="form-control" value="{{ $nama_ruas }}" />
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Kecamatan</label>
                        <input name="kecamatan" id="kecamatan" class="form-control" value="{{ $kecamatan }}" />
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Kelurahan</label>
                        <input name="kelurahan" id="kelurahan" class="form-control" value="{{ $kelurahan }}" />
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Titik Pangkal</label>
                        <input name="titik_pangkal" id="titik_pangkal" class="form-control" value="{{ $titik_pangkal }}" />

                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Titik Akhir</label>
                        <input name="titik_akhir" id="titik_akhir" class="form-control" value="{{ $titik_akhir }}" />
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Lebar</label>
                        <input name="lebar_ruas" id="lebar_ruas" class="form-control" value="{{ $lebar_ruas }}" />
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Panjang</label>
                        <input name="panjang_ruas" id="panjang_ruas" class="form-control" value="{{ $panjang_ruas }}" />
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Jenis Perkerasan</label>
												<select name="jenis_perkerasan" id="jenis_perkerasan" class="form-control">
		      		               	<option value="-">------</option>
		      		               	<option value="Hotmix" @if($jenis_perkerasan =='Hotmix') selected="selected" @endif>Hotmix</option>
		      		               	<option value="Aspal" @if($jenis_perkerasan =='Aspal') selected="selected" @endif>Aspal</option>
															<option value="Beton" @if($jenis_perkerasan =='Beton') selected="selected" @endif>Beton</option>
															<option value="Pasir dan Batu" @if($jenis_perkerasan =='Pasir dan Batu') selected="selected" @endif>Pasir dan Batu</option>
		      		          </select>
                    </div>
										<div class="form-group">
                        <label for="nama_ruas" class="col-md-2 control-label-kiri">Tahun Renovasi</label>
                        <input name="tahun_renovasi" id="tahun_renovasi" class="form-control" value="{{ $tahun_renovasi }}" />

                    </div>
										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Kondisi</label>
												<select name="id_kondisi" class="form-control">
															<option value="-">------</option>
															<option value="baik" @if($kondisi_drainase =='baik') selected="selected" @endif>Baik</option>
															<option value="sedang" @if($kondisi_drainase =='sedang') selected="selected" @endif>Sedang</option>
															<option value="rusak_ringan" @if($kondisi_drainase =='rusak_ringan') selected="selected" @endif>Rusak Ringan</option>
															<option value="rusak" @if($kondisi_drainase =='rusak') selected="selected" @endif>Rusak</option>
      		              </select>

                    </div>
										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Jenis Permukaan Jalan</label>
												<select name="jenis_permukaan_jalan" class="form-control">
														<option value="-">------</option>
      		                  <option value="pm" @if($jenis_permukaan_jalan =='pm') selected="selected" @endif>PM</option>
      		                  <option value="lapis_tipis" @if($jenis_permukaan_jalan =='lapis_tipis') selected="selected" @endif>Lapis Tipis</option>
      		              </select>

                    </div>
										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Kondisi Lapang</label>
                        <input name="nilai_rci" id="nilai_rci" class="form-control" value="{{ $nilai_rci }}" />

                    </div>
										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Kelas</label>
                      	<input name="kelas" id="kelas" class="form-control" value="{{ $kelas }}" />

                    </div>
										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Fungsi</label>
                        <input name="fungsi" id="fungsi" class="form-control" value="{{ $fungsi }}" />

                    </div>
										<div class="form-group">
                        <label for="keterangan" class="col-md-2 control-label-kiri">Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $keterangan }}</textarea>

                    </div>

										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Sempadan</label>
                        <select name="sempadan" class="form-control">
      		                      <option value="-">------</option>
      		                      <option value="ada" @if($jenis_permukaan_jalan =='ada') selected="selected" @endif>Ada</option>
      		                      <option value="tidak" @if($jenis_permukaan_jalan =='tidak') selected="selected" @endif>Tidak</option>
      		              </select>

                    </div>
										<div class="form-group">
                        <label for="jenis_permukaan_jalan" class="col-md-2 control-label-kiri">Kondisi Sempadan</label>
												<select name="kondisi_sempadan" class="form-control">
                              <option value="-">------</option>
                              <option value="baik" @if($kondisi_drainase =='baik') selected="selected" @endif>Baik</option>
                              <option value="sedang" @if($kondisi_drainase =='sedang') selected="selected" @endif>Sedang</option>
                              <option value="rusak_ringan" @if($kondisi_drainase =='rusak_ringan') selected="selected" @endif>Rusak Ringan</option>
                              <option value="rusak" @if($kondisi_drainase =='rusak') selected="selected" @endif>Rusak</option>
      		               </select>

                    </div>
										<div class="form-group">
                        <label for="drainase" class="col-md-2 control-label-kiri">Drainase</label>
                        <select name="drainase" class="form-control">
                                <option value="-">------</option>
                                <option value="ada" @if($drainase =='ada') selected="selected" @endif>Ada</option>
      		                      <option value="tidak" @if($drainase =='tidak') selected="selected" @endif>Tidak</option>
                        </select>

                    </div>
										<div class="form-group">
                        <label for="status" class="col-md-2 control-label-kiri">Kondisi Drainase</label>
                        <select name="kondisi_drainase" class="form-control">
      		                      <option value="-">------</option>
      		                      <option value="baik" @if($kondisi_drainase =='baik') selected="selected" @endif>Baik</option>
      		                      <option value="sedang" @if($kondisi_drainase =='sedang') selected="selected" @endif>Sedang</option>
                                <option value="rusak_ringan" @if($kondisi_drainase =='rusak_ringan') selected="selected" @endif>Rusak Ringan</option>
                                <option value="rusak" @if($kondisi_drainase =='rusak') selected="selected" @endif>Rusak</option>
      		              </select>

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
