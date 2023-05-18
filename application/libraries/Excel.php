<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/libraries/Classes/PHPExcel.php';
require_once APPPATH.'/libraries/Classes/PHPExcel/IOFactory.php';

class Excel
{
    private $excel;

    public function __construct()
    {
        $this->excel = new PHPExcel();
    }

    public function export($data, $filename = 'excel_export')
    {
        $this->excel->getActiveSheet()->fromArray($data, NULL, 'A1');
        
        $filename = $filename . '.xls';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $writer->save('php://output');
    }
}