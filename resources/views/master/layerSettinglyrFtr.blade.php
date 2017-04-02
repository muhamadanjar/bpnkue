@extends('layouts.adminlte')
@section('content')



<?php
$title_m = '';$caption_m = '';$url_m = '';$link_m ='';
$check;
if(!empty($identify)){
  $title = $identify->title;
  $description = $identify->description;
  $key_ = json_decode($identify->key_,true);
  $media = json_decode($identify->media,true);
 
  $lengthkey_ = count($key_);
  $lengthmedia = count($media);
  
  $encode_key = json_decode(json_encode($key_));
  
 
}
//print_r($key_);
$url_service = ($layers->tipelayer == 'dynamic' ? $layers->layerurl.'/'.$idx : $layers->layerurl);
?>
<div class="panel panel-default">
  <div class="panel-heading">{{ $judul }}</div>
  <div class="panel-body"> 
      <div class="row">
      <div class="col-sm-12">
      <form method="post" enctype="multipart/form-data" role="form" accept-charset="UTF-8">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="layerurl">Judul</label>
          <input type="hidden" class="form-control" disabled="disabled" id="layerurl" value="{{ $url_service }}" />
          <input type="text" name="title" value="{{ $title }}" class="form-control" />
          <input type="hidden" name="layerid" class="form-control" value="{{ $idx }}" />
          <input type="hidden" name="layername" class="form-control" value="{{ $layers->layer }}" />
        </div>
        <div class="form-group">
            <label for="display">Display</label>
            <select name="display" class="form-control" id="display-keyvalue">
              <option value="-">---</option>
              <option value="keyvalue" @if($identify->display == 'keyvalue') selected @endif>Key Value</option>
              <option value="custom" @if($identify->display == 'custom') selected @endif>Custom</option>
              
            </select>
        </div>
        <div class="form-group" id="deskripsi">
            <label for="description">Deskripsi</label>
            
            <textarea id="description" name="description" class="form-control">{{ $description }}</textarea>
        </div>
        <div class="form-group" id="field-list">
            <label for="title">Field</label>
            <div id="dif">
                
            </div>

            <table class="table table-bordered">
              <tr>
                <th><input type="checkbox" name="checkall" id="checkall" /></th>
                <th>Nama</th>
                <th>Alias</th>
              </tr>


              @if($lengthkey_ > 0)
                  @foreach($field->fields as $key => $a)
                  <?php $b = ($layers->tipelayer == 'dynamic' ? $a->alias : $a->name); ?>
                    @if($encode_key[$key]->fieldName == $b )
                      <?php $c = $encode_key[$key]->label; ?>
                    @else
                      <?php $c = $b ?>
                    @endif
                  <tr>
                    <td><input @if($encode_key[$key]->visible) checked @endif type="checkbox" class="checkbox" name="visible[{{ $key }}]" value="{{ $b }}" /></td>
                    <td>{{ $a->name }}<input type="hidden" name="name_field[]" value="{{ $b }}"></td>
                    <td><input type="text" class="form-control" name="label_field[]" value="{{ $c }}"></td>
                  </tr>
                  @endforeach

              @else
                  @foreach($field->fields as $key => $a)
                  <?php $b = ($layers->tipelayer == 'dynamic' ? $a->alias : $a->name); ?>
                  <tr>
                    <td><input type="checkbox" class="checkbox" name="visible[{{ $key }}]" value="{{ $b }}" /></td>
                    <td>{{ $a->name }}<input type="hidden" name="name_field[]" value="{{ $b }}"></td>
                    <td><input type="text" class="form-control" name="label_field[]" value="{{ $b }}"></td>
                  </tr>
                  @endforeach
              @endif


              
            </table>
        </div>
        <!-- Media -->
        @if($lengthmedia > 0)
        @foreach($media as $key => $vm)
          <?php $title_m = $vm['title'] ?>
          <?php $caption_m = $vm['caption'] ?>
          @if($vm['type'] == 'image')
          <?php $url_m = $vm['value']['sourceURL'] ?>
          <?php $link_m = $vm['value']['linkURL'] ?>
          @endif
        <div class="form-group">
          <label>Type</label>
          <select name="type_m" class="form-control" id="type_m">
            
            <option value="image" @if($vm['type'] == 'image') selected="selected" @endif>Image</option>
            <option value="barchart" @if($vm['type'] == 'barchart') selected="selected" @endif>Bar Chart</option>
            <option value="columnchart" @if($vm['type'] == 'columnchart') selected="selected" @endif>Column Chart</option>
            <option value="linechart" @if($vm['type'] == 'linechart') selected="selected" @endif>Line Chart</option>
            <option value="piechart" @if($vm['type'] == 'piechart') selected="selected" @endif>Pie Chart</option>
            
          </select>
          <input type="text" name="title_m" placeholder="Judul" class="form-control cols-sm-2" id="media" value="{{ $vm['title'] }}">
          <input type="text" name="caption_m" placeholder="Caption" class="form-control" id="media" value="{{ $caption_m }}">
          <input type="text" name="link_m" placeholder="Link URL" class="form-control" id="media" value="{{ $link_m }}">
          <input type="text" name="url_m" placeholder="Source URL" class="form-control" id="media" value="{{ $url_m }}">
        </div>
        <div class="form-group" id="media-list">
          <label for="title">Media</label>
          <div id="dim"></div>
            <table class="table table-bordered">
              <tr>
                <th><input type="checkbox" name="checkall-field" id="checkall-field" /></th>
                <th>Nama</th>
                <th>Alias</th>
              </tr>
              @foreach($field->fields as $key => $a)
              <?php $vg=$layers->tipelayer = 'dynamic' ? $a->alias : $a->name; ?>
              <tr>
                <td><input type="checkbox" class="checkbox-field" name="field[{{ $key }}]" value="{{ $vg }}" /></td>
                <td>{{ $a->name }}</td>
                <td>{{ $a->alias }}</td>
              </tr>
              @endforeach
              
            </table>
        </div>
        @endforeach
        @else
        <div class="form-group">
            <label>Media</label>
            <input type="checkbox" name="mediaonoff" value="1">
        </div>
        <div class="form-group">
          <label>Type</label>
          <select name="type_m" class="form-control" id="type_m">
            <option value="image">Image</option>
            <option value="barchart">Bar Chart</option>
            <option value="columnchart">Column Chart</option>
            <option value="linechart">Line Chart</option>
            <option value="piechart">Pie Chart</option>
          </select>
          <input type="text" name="title_m" placeholder="Judul" class="form-control cols-sm-2" id="media" value="{{ $title_m }}">
          <input type="text" name="caption_m" placeholder="Caption" class="form-control" id="media" value="{{ $caption_m }}">
          <input type="text" name="link_m" placeholder="Link URL" class="form-control" id="media" value="{{ $link_m }}">
          <input type="text" name="url_m" placeholder="Source URL" class="form-control" id="media" value="{{ $url_m }}">
        </div>

        <div class="form-group"></div>

        <div class="form-group" id="media-list">
          <label for="title">Media</label>
          <div id="dim"></div>
            <table class="table table-bordered">
              <tr>
                <th><input type="checkbox" name="checkall-field" id="checkall-field" /></th>
                <th>Nama</th>
                <th>Alias</th>
              </tr>
              @foreach($field->fields as $key => $a)
              <?php $vg=$layers->tipelayer = 'dynamic' ? $a->alias : $a->name; ?>
              <tr>
                <td><input type="checkbox" class="checkbox-field" name="field[{{ $key }}]" value="{{ $vg }}" /></td>
                <td>{{ $a->name }}</td>
                <td>{{ $a->alias }}</td>
              </tr>
              @endforeach
            </table>
        </div>
        @endif

        

        <div class="form-group">
            <label for="showattachments">Show Attachments</label>
            
            <input type="radio" name="showattachments" value="true" @if($identify->showattachments == true) checked="checked" @endif> Yes
            <input type="radio" name="showattachments" value="false" @if($identify->showattachments == false) checked="checked" @endif> No
            
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-sm" name="button" value="Submit">  
        </div>
      </form>
      </div>
      </div>
     
      
  </div>
</div>
@stop