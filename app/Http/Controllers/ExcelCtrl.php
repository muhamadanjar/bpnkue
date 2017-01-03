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
            for ($row = 5; $row <= $highestRow; ++ $row) {
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

    public function getImportExcel2007($value='')
    {
        $objReader = new PHPExcel_Reader_Excel2007();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load( dirname(__FILE__) . '/excel.xls' );

        $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();

        $array_data = array();
        foreach($rowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            if(1 == $row->getRowIndex ()) continue;//skip first row
            $rowIndex = $row->getRowIndex ();
            $array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');
            
            foreach ($cellIterator as $cell) {
                if('A' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('B' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('C' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
                } else if('D' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                }
            }
        }
        print_r($array_data);
    }

    function getSheets() {
        $fileName = public_path("excel.xlsx");
        try {
            $fileType = \PHPExcel_IOFactory::identify($fileName);
            $objReader = \PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load($fileName);
            $sheets = [];
            foreach ($objPHPExcel->getAllSheets() as $sheet) {
                $sheets[$sheet->getTitle()] = $sheet->toArray();
            }
            //unset($sheets['Table 1'][0]);unset($sheets['Table 1'][1]);unset($sheets['Table 1'][2]);
            return $sheets;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function postQuery($dataArr){
        foreach($dataArr as $val){
            $query = $db->query("INSERT INTO employees SET fname = '" . $db->escape($val['1']) . "', lname = '" . $db->escape($val['2']) . "', email = '" . $db->escape($val['3']) . "', phone = '" . $db->escape($val['4']) . "', company = '" . $db->escape($val['5']) . "'");
        }
    }
}
