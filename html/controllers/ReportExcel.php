<?php

use \PHPExcel;
use utilities\Util;

class ReportExcel
{

	private $objPHPExcel;
	private $data;
	private $typeReport;
	
	function __construct($typeReport)
	{
		$this->typeReport = Util::tipoReporte($typeReport);
		$this->objPHPExcel = new PHPExcel();
		$this->objPHPExcel->getProperties()->setCreator("Opemedios");
		$this->objPHPExcel->getProperties()->setLastModifiedBy("Opemedios");
		$this->objPHPExcel->getProperties()->setTitle($this->typeReport['titulo']);
		$this->objPHPExcel->getProperties()->setSubject($this->typeReport['tema']);
		$this->objPHPExcel->getProperties()->setDescription($this->typeReport['description']);
	}

	protected function make(array $data)
	{
		$this->objPHPExcel->setActiveSheetIndex(0);
  		$this->objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
		$this->objPHPExcel->getActiveSheet()->setTitle($this->typeReport['titulo']);

		return $this->objPHPExcel;
	}

	protected function download($type = 'xls')
	{
		$this->objPHPExcel->setActiveSheetIndex(0);
		
		if($type === 'xls'){
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$this->typeReport['filename'].'.xls"');
			$objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
		}else{
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$this->typeReport['filename'].'.xlsx"');
			$objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');			
		}

		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: '.gmdate('D, d M Y H:i:s T', time())); 
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s T', time()));
		header ('Cache-Control: cache, must-revalidate');
		header ('Pragma: public');
		$objWriter->save('php://output');
		exit;
	}

	protected function save($type = 'xls')
	{
		$objPHPExcel->setActiveSheetIndex(0);
		if($type === 'xls'){
			// Save Excel 95 file
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save(str_replace('.php', '.xls', __FILE__));	
		}else{
			// Save Excel 2007 file
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save(str_replace('.php', '.xlsx', __FILE__));			
		}
		
	}
}