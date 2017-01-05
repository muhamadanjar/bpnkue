<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelCtrl extends Controller{

    public function __construct($value=''){
        $this->excel =  new \PHPExcel();
    }
    public function getIndex($value=''){
        return view('excelImport');
    }

    public function postImportExcel(Request $request){
        //dd(public_path("excel.xlsx"));
        // Create new PHPExcel object
        $objPHPExcel = \PHPExcel_IOFactory::load(public_path("excel.xlsx"));
        //$objPHPExcel->setActiveSheetIndex(0)->getActiveSheet();
        
        $dataArr = array();
        
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            //echo 'Worksheet number - ', $objPHPExcel->getIndex($worksheet), PHP_EOL;
            //$index = $objPHPExcel->getWorksheetIterator()->key('Table 2');
            //echo $index;
            $worksheetTitle     = $worksheet->getTitle();
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            $rowbaru = 0;
            for ($row = 1; $row <= $highestRow; ++ $row) {
                for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getCalculatedValue(); //$cell->getValue();
                    $dataArr[$row][$col] = $val;
                }
                $rowbaru++;
            }
        }
        
        return json_encode($dataArr);
    }

    public function getImportExcel2007($file_excel=''){
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file_excel);

        $rowIterator = $objPHPExcel->setActiveSheetIndex(0)->getRowIterator();

        $array_data = array();
        foreach($rowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            if(1 == $row->getRowIndex ()) continue;//skip first row
            if(2 == $row->getRowIndex ()) continue;//skip first row
            if(3 == $row->getRowIndex ()) continue;//skip first row
            if(4 == $row->getRowIndex ()) continue;//skip first row
            
            
            $rowIndex = $row->getRowIndex ();
            $array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');
            
            foreach ($cellIterator as $cell) {
                if('A' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('B' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('C' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = \PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
                } else if('D' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('E' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('F' == $cell->getColumn()){
                    
                    $date ='';
                    $date = $cell->getCalculatedValue();
                    //$value = (isset($value) ? $value:0);
                    $my_date = date('Y-m-d', strtotime($date));
                    $array_data[$rowIndex][$cell->getColumn()] = $my_date;
                }else{
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                }
            }
        }
        return $array_data;
    }

    function getSheets() {
        $fileName = public_path("excel.xlsx");
        try {
            $fileType = \PHPExcel_IOFactory::identify($fileName);
            $objReader = \PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load($fileName);
            $sheets = [];
            //dd($objPHPExcel->getAllSheets());
            foreach ($objPHPExcel->getAllSheets() as $sheet) {
                $sheets[$sheet->getTitle()] = $sheet->toArray();
            }
            //unset($sheets['Table 1'][0]);unset($sheets['Table 1'][1]);unset($sheets['Table 1'][2]);
            return $sheets;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function QueryBagianSatu($dataArr){
        $array = array('info'=>false);
        try{
            foreach($dataArr as $val){
                \DB::table('kuesioner_bagian_satu_repos')->insert([
                    [
                        'nama_input' => $val['A'],
                        'kode' => $val['B'], 
                        'nomor_kuesioner' => $val['C'],
                        'nomor_bsn' => $val['D'],
                        'nama_surveyor' => $val['E'],
                        'tgl_survey' => date('Y-m-d'),
                        'propinsi' => $val['G'],
                        'i_1' => $val['H'],
                        'i_2' => $val['I'],
                        'i_3' => $val['J'],
                        'i_4' => $val['K'],
                        'i_5' => $val['L'],
                        'i_6' => $val['M'],
                        'i_7' => $val['N'],
                        'i_8' => $val['O'],
                        'i_9' => $val['P'],
                        'i_10' => $val['Q'],
                        'i_10_a' => $val['R'],
                        'i_10_b' => $val['S'],
                        'i_11' => $val['Z'],
                        'i_11_a' => $val['AA'],
                        'i_12' => $val['AB'],
                        'i_12_a' => $val['AC'],
                        'i_13' => $val['AD'],
                        'i_13_a' => $val['AE'],
                        'i_14' => $val['AF'],
                        'i_15' => $val['AG'],
                        'i_16' => $val['AH'],
                        'jenis_umk' => $val['AI'],
                        
                    ],
                    
                ]);
            }
            $array['info'] = true;
        }catch(Exception $e){
            \DB::rollback();
            $array['info'] = false;
            throw $e;
        }

        return json_encode($array);
        
    }

    public function postQueryBagianSatu(Request $request){
        $fupload = $request->file('file');
        $vdir_upload ='files';
        $fileName=str_random(20) . '.' . $fupload->getClientOriginalExtension();
        $destinationPath = public_path().'/'.$vdir_upload;
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777);
            //echo "The directory $destinationPath was successfully created.";
            //exit;
        } else {
            //echo "The directory $destinationPath exists.";
        }
        $fuploadName = $fupload->getClientOriginalName();
        $fupload->move($destinationPath, $fileName);
        $lokasi_file = $destinationPath.'/'.$fileName;
        $data = $this->getImportExcel2007($lokasi_file);
       
        $this->QueryBagianSatu($data);

        \File::delete($lokasi_file);

        return redirect('/excel');
    }

    
}
