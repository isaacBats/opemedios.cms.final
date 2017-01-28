<?php

use \PHPExcel;
use utilities\Util;

class ReportExcel
{

	private $objPHPExcel;
	private $data;
	
	function __construct( PHPExcel $objPHPExcel, $typeReport, $data = array() )
	{
		$this->objPHPExcel = $objPHPExcel;
		$this->objPHPExcel->getProperties()->setCreator("Opemedios");
		$this->objPHPExcel->getProperties()->setLastModifiedBy("Opemedios");
		$this->objPHPExcel->getProperties()->setTitle(Util::tipoReporte($typeReport)['Title']);
		$this->objPHPExcel->getProperties()->setSubject(Util::tipoReporte($typeReport)['tema']);
		$this->objPHPExcel->getProperties()->setDescription(Util::tipoReporte($typeReport)['description']);
	}
}