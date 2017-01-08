<?php 

namespace Opemedios\models;

use utilities\Util;

class Encabezado
{
	private $id;
	private $id_noticia;
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

	
	public function __construct( array $encabezado )
	{
		$this->id = ( isset( $encabezado['id'] ) && !empty( $encabezado['id'] ) ) ? $encabezado['id'] : null;
		$this->id_noticia = ( isset( $encabezado['id_noticia'] ) && !empty( $encabezado['id_noticia'] ) ) ? $encabezado['id_noticia'] : null;
		$this->logo = ( isset( $encabezado['logo'] ) && !empty( $encabezado['logo'] ) ) ? $encabezado['logo'] : null;
		$this->fecha = ( isset( $encabezado['fecha'] ) && !empty( $encabezado['fecha'] ) ) ? $encabezado['fecha'] : Util::getUnixDate();
		$this->numeroPagina = ( isset( $encabezado['num_pagina'] ) && !empty( $encabezado['num_pagina'] ) ) ? $encabezado['num_pagina'] : 0;
		$this->seccion = ( isset( $encabezado['seccion'] ) && !empty( $encabezado['seccion'] ) ) ? $encabezado['seccion'] : null;
		$this->tiraje = ( isset( $encabezado['tiraje'] ) && !empty( $encabezado['tiraje'] ) ) ? $encabezado['tiraje'] : 0;		
		$this->fraccion = ( isset( $encabezado['fraccion'] ) && !empty( $encabezado['fraccion'] ) ) ? $this->validaFraccion( $encabezado['fraccion'] ) : [ 'float' => 0, 'string' => '0'];
		$this->impactos = ( isset( $encabezado['impactos'] ) && !empty( $encabezado['impactos'] ) ) ? $encabezado['impactos'] : $this->buildImpactos();
		$this->porcentaje = ( isset( $encabezado['porcentaje'] ) && !empty( $encabezado['porcentaje'] ) ) ? $encabezado['porcentaje'] : $this->buildPorcentaje();
		$this->costoXcm = ( isset( $encabezado['costo_cm'] ) && !empty( $encabezado['costo_cm'] ) ) ? $encabezado['costo_cm'] : 0;
		$this->costoNota = ( isset( $encabezado['costo_nota'] ) && !empty( $encabezado['costo_nota'] ) ) ? $encabezado['costo_nota'] : 0;
		$this->tamanio = $this->id_noticia = ( isset( $encabezado['tamanio'] ) && !empty( $encabezado['tamanio'] ) ) ? $encabezado['tamanio'] : 0; 

	}

	private function validaFraccion( $fraccion )
	{
		if( is_array( $fraccion ) )
			return $fraccion;

		$explode = explode('/', $fraccion );
		$float = $explode[0] / $explode[1];

		return [ 'string' => $fraccion, 'float' => $float ];
	}

	public function getFraccion()
	{
		return $this->fraccion;
	}

	public function buildImpactos()
	{
		if( $this->tiraje > 0 )
			return  $this->tiraje * 3;
		else
			return null;
	}

	public function buildPorcentaje()
	{
		return round( $this->getFraccion()['float'] * 100 );
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