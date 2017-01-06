<?php 

namespace Opemedios\models;

use utilities\Util;

class Encabezado
{
	private $id;
	private $logo;
	private $impactos;
	private $costoXcm;
	private $costoNota;
	private $fecha;
	private $fraccion;
	private $numeroPagina;
	private $porcentaje;
	private $seccion;
	private $tamanio;
	private $tiraje;


	// public function __construct( $logo, $pagina, $seccion, $tiraje, $fecha, $fraccion,  $id = 0 )
	public function __construct( array $encabezado )
	{
		$this->id = ( isset( $encabezado['id'] ) && !empty( $encabezado['id'] ) ) ? $encabezado['id'] : null;
		$this->logo = ( isset( $encabezado['logo'] ) && !empty( $encabezado['logo'] ) ) ? $encabezado['logo'] : null;
		$this->fecha = ( isset( $encabezado['fecha'] ) && !empty( $encabezado['fecha'] ) ) ? $encabezado['fecha'] : Util::getUnixDate();
		$this->numeroPagina = ( isset( $encabezado['num_pagina'] ) && !empty( $encabezado['num_pagina'] ) ) ? $encabezado['num_pagina'] : 0;
		$this->seccion = ( isset( $encabezado['seccion'] ) && !empty( $encabezado['seccion'] ) ) ? $encabezado['seccion'] : null;
		$this->tiraje = ( isset( $encabezado['tiraje'] ) && !empty( $encabezado['tiraje'] ) ) ? $encabezado['tiraje'] : 0;		
		// TODO: @Encabezado LA fraccion debe de comprender dos valores; el string con el valor en fraccion y del valor de la fraccion es decir un decimal.
		$this->fraccion = ( isset( $encabezado['fraccion'] ) && !empty( $encabezado['fraccion'] ) ) ? $this->validaFraccion( $encabezado['fraccion'] ) : 0.0;
	}

	private function validaFraccion( $fraccion )
	{
		if( is_float( $fraccion ) )
			return $fraccion;

		$explode = explode('/', $fraccion );
		
		return $explode[0] / $explode[1];
	}

	public function getFraccion()
	{
		return $this->fraccion;
	}

	public function getImpactos()
	{
		$this->impactos = $this->tiraje * 3;

		return $this->impactos;
	}

	public function getPorcentaje()
	{
		$this->porcentaje = round( $this->getFraccion() * 100 ) / 100;

		return $this->porcentaje;
	}

	public function getEncabezado()
	{
		return [
					'id' 	       => $this->getId(),
					'logo'     => $this->getlogo(),
					'impactos'     => $this->getImpactos(),
					'costoXcm'     => $this->getCostoXcm(),
					'costoNota'    => $this->getCostoNota(),
					'fecha' 	   => $this->getFecha(),
					'fraccion'     => $this->getFraccion(),
					'numeroPagina' => $this->getNumeroPagina(),
					'porcentaje'   => $this->getPorcentaje(),
					'seccion'      => $this->getSeccion(),
					'tamanio'      => $this->getTamanio(),
					'tiraje'       => $this->getTiraje()
			   ];
	}

}