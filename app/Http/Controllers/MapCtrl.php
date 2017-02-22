<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Layer;
use App\Identify;
use Illuminate\Http\Request;
//use App\Http\Controllers\SettingWebCtrl;

class MapCtrl extends Controller {

	public function __construct(Request $r){
		//$this->middleware('date_expired');
		//$this->_setting = new SettingWebCtrl();
		$this->_r = $r;
	}
	public function getIndex(){
		//$this->_setting->getVisitor($this->_r);
		$layer = $this->getLayer();
		$identify = $this->getIdentify();
		return view('map')->withLayer($layer)->withIdentify($identify);
	}

	public function getLayer(){
		return $this->LayerUser();
	}

	public function LayerUser(){
		
		$layers = Layer::where('na','=','0')->orderBy('orderlayer','DESC');
		
		$sql = $layers->toSql();
		$run_layers = $layers->get();
		
		$array = array(); $operationallayer = array();
			foreach ($run_layers as $klyr => $layer) {
				$optionfeature['id'] = $layer->layer;
				$optionfeature['opacity'] = $layer->option_opacity;
				$optionfeature['visible'] = $layer->option_visible;
				$optionfeature['outFields'] = ['*'];
				$optionfeature['mode'] = 1;
			        
			    $optiondynamic['id'] = $layer->layer;  
			    $optiondynamic['opacity'] = $layer->option_opacity;
			    $optiondynamic['visible'] = $layer->option_visible;
			    $optiondynamic['outFields'] = ['*'];
			    $optiondynamic['imageParameters'] = '';

			    $layerControlLayerInfos['swipe'] = true;
			    $layerControlLayerInfos['metadataUrl'] = true;
			    $layerControlLayerInfos['expanded'] = false;
			    
			    $options = ($layer->tipelayer=='dynamic' ?  $optiondynamic : $optionfeature); 

			    $operationallayer_['type'] = $layer->tipelayer;
			    $operationallayer_['url'] =  $layer->layerurl;
			    $operationallayer_['title'] = $layer->layername;
			    $operationallayer_['options'] = $options;
			    $operationallayer_['layerControlLayerInfos'] = $layerControlLayerInfos;

			    $layerIds = ['layerIds' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]];
			    $operationallayer_['identifyLayerInfos'] = $layerIds;
			    $operationallayer_['roles'] = $layer->roles;
			    array_push($operationallayer, $operationallayer_);
			}
		
		return json_encode($operationallayer);

	}

	public function getIdentify(){
		$identify = Identify::orderBy('layerid','ASC')->get();
		$url = url();
		$link = '';
		$arrayname = array();
		$arraylayerid = array();
		$arrayfieldinfo = array(); $arrayfieldinfos = array();
		$n = array();
		foreach ($identify as $key => $value) {

			unset($arraylayerid);
			unset($arrayfieldinfos);
			$kodec = base64_encode($value['tablename']);
			$value['key_'] = json_decode($value['key_']);
			$value['media'] = json_decode($value['media']);
			$arrayfieldinfo = $value['key_'];
			
			$arrayfieldinfos['title'] = $value->title;
			if ($value['display'] == 'keyvalue') {
				$arrayfieldinfos['fieldInfos'] = $arrayfieldinfo;
			}else{
				$arrayfieldinfos['description'] = $value['description'].$link;
			}
			$arrayfieldinfos['showAttachments'] = $value['showattachments'];
			$arrayfieldinfos['mediaInfos'] = $value['media'];
			
			$arraylayerid[(int)$value['layerid']] = $arrayfieldinfos;
			if(array_key_exists($value['layername'],$arrayname)){
				$arrayname[$value['layername']] += $arraylayerid;
			}else{
				$arrayname[$value['layername']] = $arraylayerid;
			}

		}

		return json_encode($arrayname);
	}

	public function GetTableCanEdit(){
        $query = Identify::leftJoin('identify_table', function($join) {
	      $join->on('Identify.id_identify', '=', 'identify_table.id_identify');
	    })->get([
	        'Identify.id_identify',
	        'Identify.title',
	        'Identify.layername',
	        'Identify.layerid',
	        'Identify.display',
	        'Identify.description',
	        'Identify.key_',
	        'Identify.media',
	        'Identify.showattachments',
	        'identify_table.tablename'
	    ]);
        return $query;
	}

	

}
