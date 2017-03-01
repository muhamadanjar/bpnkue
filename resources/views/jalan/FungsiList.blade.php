@extends('layouts.adminlte')
@section('content')
	
		<div class="panel panel-default">
			<div class="panel-heading">
			 	<h6 class="panel-title"><i class="icon-file"></i> Jalan Fungsi</h6>
			</div>	
			<div class="form-actions text-left">
		    	
		    </div>
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
										<ul class="dropdown-menu icons-right dropdown-menu-right">
											<li><a href="{{ url('admin/jalan/fungsi',array($p->id,'edit')) }}">Edit</a></li>
											<li><a href="#">Hapus</a></li>
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

@stop