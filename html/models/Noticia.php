<?php 

namespace Opemedios\models;

use Opememdios\models\Autor;
use Opememdios\models\Fuente;
use Opememdios\models\Usuario;
use Opememdios\models\Archivo;
use Opememdios\models\Empresa;

class Noticia{

	private $id;
	private $titulo;
	private $sintesis;
	private Autor $autor;
	private $fechaNoticia;
	private $comentario;
	private $tipoFuente;
    private Fuente $fuente;
	private $genero;
	private $tendencia;
	private Usuario $usuario;
	private Archivo $archivo;
    private Empresa $empresa;
    private $createdAt;

    
    public function getAutor()
    {
        return $this->author;
    }

    public function setAutor( Autor $autor )
    {
        if( !is_empty( $autor->name ) )
        $this->autor = $autor;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId( $id )
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of titulo.
     *
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Sets the value of titulo.
     *
     * @param mixed $titulo the titulo
     *
     * @return self
     */
    public function setTitulo( $titulo )
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Gets the value of sintesis.
     *
     * @return mixed
     */
    public function getSintesis()
    {
        return $this->sintesis;
    }

    /**
     * Sets the value of sintesis.
     *
     * @param mixed $sintesis the sintesis
     *
     * @return self
     */
    public function setSintesis( $sintesis )
    {
        $this->sintesis = $sintesis;

        return $this;
    }

    /**
     * Gets the value of fechaNoticia.
     *
     * @return mixed
     */
    public function getFechaNoticia()
    {
        return $this->fechaNoticia;
    }

    /**
     * Sets the value of fechaNoticia.
     *
     * @param mixed $fechaNoticia the fecha noticia
     *
     * @return self
     */
    public function setFechaNoticia( $fechaNoticia )
    {
        $this->fechaNoticia = $fechaNoticia;

        return $this;
    }

    /**
     * Gets the value of comentario.
     *
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Sets the value of comentario.
     *
     * @param mixed $comentario the comentario
     *
     * @return self
     */
    public function setComentario( $comentario )
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Gets the value of tipoFuente.
     *
     * @return mixed
     */
    public function getTipoFuente()
    {
        return $this->tipoFuente;
    }

    /**
     * Sets the value of tipoFuente.
     *
     * @param mixed $tipoFuente the tipo fuente
     *
     * @return self
     */
    public function setTipoFuente( $tipoFuente )
    {
        $this->tipoFuente = $tipoFuente;

        return $this;
    }

    /**
     * Gets the value of genero.
     *
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Sets the value of genero.
     *
     * @param mixed $genero the genero
     *
     * @return self
     */
    public function setGenero( $genero )
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Gets the value of tendencia.
     *
     * @return mixed
     */
    public function getTendencia()
    {
        return $this->tendencia;
    }

    /**
     * Sets the value of tendencia.
     *
     * @param mixed $tendencia the tendencia
     *
     * @return self
     */
    public function setTendencia( $tendencia )
    {
        $this->tendencia = $tendencia;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mixed $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt( $createdAt )
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}