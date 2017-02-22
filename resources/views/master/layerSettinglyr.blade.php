@extends('layouts.adminlte')
@section('content')
<script src="{{ asset('3.12compact/init.js') }}"></script>


<div class="panel panel-default">
  <div class="panel-heading">{{ $title }}</div>
  <div class="panel-body"> 
      <div class="row">
      <div class="col-sm-12">
      <form>
        <div class="form-group">
          <label for="layerurl">URL</label>
          <input type="text" class="form-control" id="layerurl" value="{{ $layers->layerurl }}" placeholder="Layer URL" disabled="disabled">
          <input type="text" class="form-control" id="layer" value="{{ $layers->layer }}" placeholder="Layer" disabled="disabled">
        </div>
        <div id="content"></div>
        <div class="form-group">
            <ul id="list-group" class="list-group">
              
            </ul>
            <ul class="list-group">
             
              @if(count($field) > 0)
              
              @foreach($field as $key => $d)
                
                <?php $fields = $d->fields ?>
                <li class="list-group-item">{{ $d->name }} 
                  @if(count($fields) > 0)
                  <a class="btn btn-primary btn-xs" 
                  href="{{ url('/layers/layerinfopopup',array($layers->id_layer,$d->id,$layers->layer)) }}">
                    <i class="fa fa-pencil-square-o"></i>
                  </a>
                  @endif
                </li>
              @endforeach
              @else
                <div class="row">
                  <div class="col-sm-12">
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                          Tolong Update Layer Untuk Mendapatkan Info.<br>
                          Untuk Update Silakan Link berikut.
                          <a href="{{ url('/layers/ubah',array($id)) }}" class="alert-link">Link</a>
                    </div>
                  </div>
                </div>
                
              @endif
            </ul>
        </div>
      </form>
      </div>
      </div>
  </div>
</div>
@stop