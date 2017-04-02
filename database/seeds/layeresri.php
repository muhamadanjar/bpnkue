<?php

use Illuminate\Database\Seeder;
use App\Layer;
class LayerEsri extends Seeder{

    public function run(){
        $layer_administrasi = Layer::create([
            'layername' => 'Administrasi',
            'tipelayer' => 'dynamic',
            'layerurl' => 'http://silver-pc:6080/arcgis/rest/services/PANDEGLANG/Peta_Administrasi/MapServer',
            'layer' => 'administrasi',
            'orderlayer' => 0,
        ]);

        $layer_jaringan_jalan = Layer::create([
            'layername' => 'Jaringan Jalan',
            'tipelayer' => 'dynamic',
            'layerurl' => 'http://silver-pc:6080/arcgis/rest/services/PANDEGLANG/Peta_Jaringan_Jalan/MapServer',
            'layer' => 'jaringan_jalan',
            'orderlayer' => 1,
        ]);

        $layer_tematik = Layer::create([
            'layername' => 'Tematik',
            'tipelayer' => 'dynamic',
            'layerurl' => 'http://silver-pc:6080/arcgis/rest/services/PANDEGLANG/Peta_Tematik/MapServer',
            'layer' => 'tematik',
            'orderlayer' => 3,
        ]);
    }
}
