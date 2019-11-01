<?php

use utilities\TipoReporte;
use utilities\Util;

require __OPEMEDIOS__ . 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

class ReportExcel
{

	private $objPHPExcel;
	private $objReader;
	private $data;
	private $typeReport;
	private $typeFile = 'Excel2007';
	private $borders;

	function __construct($typeReport)
	{
		$this->typeReport = Util::tipoReporte($typeReport);
		if($typeReport == TipoReporte::REPORTE_CLIENTE) {
            $this->objReader = PHPExcel_IOFactory::createReader($this->typeFile);
            $this->objPHPExcel = $this->objReader
                ->load(__OPEMEDIOS__ . 'assets/templates/template_client.xlsx');
		} else {
			$this->objPHPExcel = new PHPExcel();

		}
		$this->borders = array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
		$this->objPHPExcel->getProperties()->setCreator("Opemedios");
		$this->objPHPExcel->getProperties()->setLastModifiedBy("Opemedios");
		$this->objPHPExcel->getProperties()->setTitle($this->typeReport['titulo']);
		$this->objPHPExcel->getProperties()->setSubject($this->typeReport['tema']);
		$this->objPHPExcel->getProperties()->setDescription($this->typeReport['descripcion']);
	}

	public function make(array $data, $filters)
	{
		// $this
		$tsinicio 	= strtotime($filters['fechas_reporte']['fecha_inicio']);
		$tsfin 		= strtotime($filters['fechas_reporte']['fecha_fin']);
		$SDateStart = date('d-F-Y', $tsinicio);
		$SDateEnd 	= date('d-F-Y', $tsfin);
		$this->objPHPExcel->getActiveSheet()
		->setTitle($this->typeReport['titulo'])
		->setCellValue('A6', 'Reporte generado el ' . getFechaLarga(date('Y-m-d')))
		->setCellValue('A7', 'I. Parámetros del reporte:')
		->setCellValue('A9', 'Monitoreo efectuado del '.$SDateStart.' al '.$SDateEnd);
		return $this;
	}

	// public function setHeaders(array $headers)
	// {
	// 	$this->objPHPExcel->setActiveSheetIndex(0);
	// 	$this->objPHPExcel->getActiveSheet()->fromArray($headers, null, 'A1');

	// 	return $this;
	// }
	/**
	 * Llena el excel con el resultado del query con los filtros del formulario
	 * @param  Array $news    arreglo de noticias del query sql
	 * @param  Array $filters filtros del formulario
	 * @return ReportExcel    this
	 */
	public function fillClientReport($arguments)
	{
		//print_r($news);
		//die("break");
		$this->make($arguments['news'], $arguments['filters']); //set titles
		//tbl params (filters)
		$filters = $arguments['filters'];
		$this->objPHPExcel->getActiveSheet()
		->setCellValue('A10', "Tema:")
		->setCellValue('A11', $filters['tema'])
		->setCellValue('B10', "Tipo de Fuente:")
		->setCellValue('B11', $filters['tipo_fuente'])
		->setCellValue('C10', "Fuente:")
		->setCellValue('C11', $filters['fuente'])
		->setCellValue('D10', "Sección:")
		->setCellValue('D11', $filters['seccion'])
		->setCellValue('A12', "Sector:")
		->setCellValue('A13', $filters['sector'])
		->setCellValue('B12', "Género:")
		->setCellValue('B13', $filters['genero'])
		->setCellValue('C12', "Tipo de Autor:")
		->setCellValue('C13', $filters['tipo_autor'])
		->setCellValue('D12', "Tendencia:")
		->setCellValue('D13', $filters['tendencia']);

		$this->objPHPExcel->getActiveSheet()->getStyle('A10:D13')->applyFromArray($this->borders);

		$this->objPHPExcel->getActiveSheet()
		->setCellValue('A15', 'III. Estadísticas:')
		->setCellValue('A17', '2.1 Tipo de Fuente / Fuente / Sección: (Número de Noticias)')
		//tbl 2.1
		->setCellValue('A19', 'Tipo de Fuente')
		->setCellValue('B19', 'Fuente')
		->setCellValue('C19', 'Sección');
		
		
		$row = 24; //ultimo numero de fila que se quedo la tbl 2.1
		/*->setCellValue('A20', 'TOTAL DE NOTICIAS: ')*/
		//tbl 2.2
		$borderStart	= $row + 3;
		$this->objPHPExcel->getActiveSheet()
		->setCellValue('A'.$row+=1, 'Otros Atributos: (Número de Noticias)')
		->setCellValue('A'.$row+=2, 'Sector:')
		->setCellValue('B'.$row, 'Género')
		->setCellValue('C'.$row, 'Tipo de Autor: ')
		->setCellValue('D'.$row, 'Tendencia:');
		
		$startTbl 	= $row+=1;
		$sheet 		= $this->objPHPExcel->getActiveSheet();
		$atributos 	= $arguments['totalPorAtributos']; 
		foreach ($atributos->sector as $sector => $total) {
			$sheet->setCellValue('A'.$row, $sector . ":" . $total);
			$row++;
		}
		$row = $startTbl;
		foreach ($atributos->genero as $genero => $total) {
			$sheet->setCellValue('B'.$row, $genero . ":" . $total);
			$row++;
		}
		$row = $startTbl;
		foreach ($atributos->tipoAutor as $tipo_autor => $total) {
			$sheet->setCellValue('C'.$row, $tipo_autor . ":" . $total);
			$row++;
		}
		$row = $startTbl;
		foreach ($atributos->tendencia as $tendencia => $total) {
			$sheet->setCellValue('D'.$row, $tendencia . ":" . $total);
			$row++;
		}

		$sheet->getStyle('A'.$borderStart.':D'.$row)->applyFromArray($this->borders);

		$row = $sheet->getHighestDataRow();
		//tbl 3
		$sheet = $this->objPHPExcel->getActiveSheet();
		$borderStart = $row + 7;
		$sheet->setCellValue('A'.$row+=3, 'III. Noticias:')
		->setCellValue('A'.$row+=2, 'Por Tema: (Número de noticias)')
		->setCellValue('A'.$row+=2, 'Tema')
		->setCellValue('B'.$row, 'Noticias');
		$row+=1;
		foreach ($arguments['totalPorTema'] as $tema => $total) {
			$sheet->setCellValue('A'.$row, $tema);
			$sheet->setCellValue('B'.$row, $total);
			$row++;
		}
		$sheet->getStyle('A'.$borderStart.':B'.$row)->applyFromArray($this->borders);

		$row = $sheet->getHighestDataRow();

		//tbl 2.2
		$sheet = $this->objPHPExcel->getActiveSheet();
		$row+=3;
		$borderStart = $row;
		$sheet->setCellValue('A40', 'Detalle de Noticias');
		$ADetalle = $arguments['detalle'];
		foreach ($ADetalle as $tema => $ANoticias) {
			//Titulo tema
			$sheet->setCellValue('A'.$row, 'TEMA: '.$tema);
			$row+=1;
			//poner los encabezados
			$sheet->setCellValue('A'.$row, "Medio");
			$sheet->setCellValue('B'.$row, "Fuente");
			$sheet->setCellValue('C'.$row, "Id Noticia");
			$sheet->setCellValue('D'.$row, "Encabezado");
			$sheet->setCellValue('E'.$row, "Síntesis");
			$sheet->setCellValue('F'.$row, "Tendencia");
			$sheet->setCellValue('G'.$row, "Costo");
			$sheet->setCellValue('H'.$row, "Alcanse");
			$sheet->setCellValue('I'.$row, "Fecha");
			$row+=1;
			foreach ($ANoticias as $key => $noticia) {
				//llenar la filas con detalle de noticia
				$sheet->setCellValue('A'.$row, $noticia['tipo_fuente']);
				$sheet->setCellValue('B'.$row, $noticia['fuente']);
				$sheet->setCellValue('C'.$row, $noticia['id_noticia']);
				$sheet->setCellValue('D'.$row, $noticia['encabezado']);
				$sheet->setCellValue('E'.$row, $noticia['sintesis']);
				$sheet->setCellValue('F'.$row, $noticia['tendencia']);
				$sheet->setCellValue('G'.$row, $noticia['costo']);
				$sheet->setCellValue('H'.$row, $noticia['alcanse']);
				$sheet->setCellValue('I'.$row, $noticia['fecha']);
				$row+=1;
			}
		}
		$sheet->getStyle('A'.$borderStart.':I'.$row)->applyFromArray($this->borders);

		return $this;
	}

	public function download($type = 'xls')
	{
		$this->objPHPExcel->setActiveSheetIndex(0);

		if($type === 'xls'){
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$this->typeReport['filename'].'_'.date("YmdHis").'.xls"');
			$objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
		}else{
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$this->typeReport['filename'].'_'.date("YmdHis").'.xlsx"');
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
