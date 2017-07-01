<?php

use utilities\Util;
require __OPEMEDIOS__ . 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

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
		$this->objPHPExcel->getProperties()->setDescription($this->typeReport['descripcion']);
	}

	public function make(array $data)
	{
		$i = 2;
		foreach ($data as $key => $value) {
			$this->objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A{$i}", $value['medio'])
			->setCellValue("B{$i}", $value['fuente'])
			->setCellValue("C{$i}", $value['encabezado'])
			->setCellValue("D{$i}", $value['sintesis'])
			->setCellValue("E{$i}", $value['tendencia'])
			->setCellValue("F{$i}", $value['costo'])
			->setCellValue("G{$i}", $value['alcance'])
			->setCellValue("H{$i}", $value['fecha'])
			->setCellValue("I{$i}", 'Ver');
			$this->objPHPExcel->getActiveSheet()->getCell("I{$i}")->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);
			$this->objPHPExcel->getActiveSheet()->getCell("I{$i}")->getHyperlink()->setUrl(strip_tags('http://'.$value['link']));
			$i++;
		}
		$this->objPHPExcel->getActiveSheet()->setTitle($this->typeReport['titulo']);

		return $this;
	}

	public function setHeaders(array $headers)
	{
		$this->objPHPExcel->setActiveSheetIndex(0);
		$this->objPHPExcel->getActiveSheet()->fromArray($headers, null, 'A1');

		return $this;
	}

	public function download($type = 'xls')
	{
		$this->objPHPExcel->setActiveSheetIndex(0);
		
		if($type === 'xls'){
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$this->typeReport['filename'].'_'.date(YmdHis).'.xls"');
			$objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
		}else{
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$this->typeReport['filename'].'_'.date(YmdHis).'.xlsx"');
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

	public function save($type = 'xls')
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