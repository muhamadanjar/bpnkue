@extends('layouts.adminlte')
@section('content')
	
		<div class="box box-default">
			<div class="box-header">
			 	<h6 class="box-title"><i class="icon-file"></i> Jalan Fungsi</h6>
			 	<div class="box-tools pull-right">
	               <a href="{{ url('admin/jalan/fungsi/add') }}" type="button" class="btn btn-success">Tambah</a>
	            </div>
			</div>
			<div class="box-body no-padding">
				<div class="datatable">
				    <table class="table table-striped table-bordered">
				        <thead>
				            <tr>
				                <th>#</th>
				                <th>Kode Ruas</th>
				                <th>Nama</th>
				                <th>Panjang</th>
								<th>Lebar</th>
								<th>status</th>
								<th>Keterangan</th>
				            </tr>
				        </thead>
				        <tbody>
				        @foreach($jalan as $key => $p)
				        										
							<tr>
				                <td>
					                <div class="btn-group">
									    <button data-toggle="dropdown" class="btn btn-default btn-flat dropdown-toggle" type="button">
									    <i class="caret"></i>&nbsp;
									    </button>
										<ul class="dropdown-menu">
											<li><a href="{{ url('admin/jalan/fungsi',array($p->id,'edit')) }}">Edit</a></li>
											<li 
												data-form="#frmDelete-{{ $p->id }}" 
												data-title="Delete Fungsi" 
												data-message="Anda yakin menghapus fungsi jalan ?">
											<a href="#" class="formConfirm">Hapus</a></li>
											<form 
					                            action="{{ url('admin/jalan/fungsi', array($p->id,'delete')) }}" 
					                            method="post" 
					                            style="display:none" 
					                            id="frmDelete-{{ $p->id}}">
					                            {{ csrf_field() }}
					                        	<input name="_method" type="hidden" value="DELETE">    
					                        </form>
						                    <li class="divider"></li>
						                    <li><a href="{{ url('admin/jalan/fungsi',array($p->id,'editmap')) }}">Lihat Peta</a></li>
									    </ul>
								    </div>
				    			</td>
				                <td>{{ $p->kode_ruas }}</td>
				                <td>{{ $p->nama }}</td>
				                <td class="text-center"><span class="label label-info">{{ $p->panjang }}</span></td>
								<td class="text-center"><span class="label label-info">{{ $p->lebar }}</span></td>
								<td>{{ $p->status }}</td>
								<td>{{ $p->keterangan }}</td>
				            </tr>
						@endforeach
				        </tbody>
				    </table>           
			    </div>
			</div>	
		</div>	

@stop