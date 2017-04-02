@extends('layouts.adminlte')

@section('content')
		<div class="box box-default">
			<div class="box-header with-border">
			 	<h6 class="box-title"><i class="icon-file"></i> Layer - layer</h6>
				<a href="{{ url('layers/tambah') }}">
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
				                <th>Nama Layer</th>
				                <th>Url</th>
				                <th>Layer</th>
				                <th>#</th>
				            </tr>
				        </thead>
				        <tbody>

				            @foreach($layer as $key => $p)
				            	<?php $disabled = ($p->jsonfield != null) ? '' : 'disabled' ;  ?>											
								<tr>
				                    <td>{{ $p->layername }}</td>
				                    <td><a href="{{$p->layerurl}}" class="btn btn-link">Link</a></td>
				                    <td>{{ $p->layer }}</td>
				                    <td>
				                        <div class="btn-group">
					                        <button data-toggle="dropdown" class="btn btn-icon btn-success dropdown-toggle" type="button"><i class="fa fa-ellipsis-v"></i>&nbsp;</button>
												<ul class="dropdown-menu icons-right dropdown-menu-right">
													<li><a href="{{ url('layers/ubah', array($p->id_layer)) }}"><i class="fa fa-edit"></i> Ubah</a></li>

													<li data-form="#frmDelete-{{ $p->id_layer }}" data-title="Delete Layer" data-message="Are you sure you want to hapus layer ?">
															<a class = "formConfirm" href="#"><i class="fa fa-close"></i> Hapus</a>
													</li>
														<form method="get" 
														action="{{ url('layers/hapus/'.$p->id_layer) }}"
														style="display:none" 
														id="frmDelete-{{$p->id_layer}}">
															
														</form>

													<li class="divider"></li>
					                                <li><a href="{{ url('layers/layerinfo',array($p->id_layer)) }}">
					                                    <i class="fa fa-bars"></i> Setting PopUp</a>
					                                </li>
					                                <li class="{{$disabled}}" 
					                                        data-form="#frmCEsri-{{ $p->id_layer }}" 
					                                        data-title="Hapus data esri {{ $p->layername }}" 
					                                        data-message="apa anda yakin menghapus data esri {{ $p->layername }} ?">
					                                        <a class= "formConfirm" href="#"><i class="fa fa-bell" disabled></i> Hapus data Esri</a>
					                                </li>
					                                <form 
					                                    action="{{ url('/layers/layeresrihapus', array($p->id_layer)) }}" 
					                                    method="get" 
					                                    style="display:none" 
					                                    id="frmCEsri-{{ $p->id_layer}}"></form>
					                            </ul>
				                        </div>
				                    </td>
				                </tr>
							@endforeach

				        </tbody>
				    </table>           
			    </div>
			</div>
		</div>	
@stop