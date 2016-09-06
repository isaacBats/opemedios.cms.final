<?php 

namespace Opemedios\models;

class Noticia{

	private $id;
	private $titulo;
	private $sintesis;
	private $autor;
	private $fechaNoticia;
	private $comentario;
	private $tipoFuente;
	private $seccionFuente;
	private $tipoAutor;
	private $genero;
	private $tendencia;
	private $usuario;
	private $archivo;
	private $createdAt;



    /**
     * Gets the value of id.
     *
     * @return int
     */
    potected function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param int $id the id
     *
     * @return self
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of titulo.
     *
     * @return string
     */
    potected function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Sets the value of titulo.
     *
     * @param string $titulo the titulo
     *
     * @return self
     */
    private function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }
    /**
     * Gets the value of sintesis.
     *
     * @return string
     */
    potected function getSintesis()
    {
        return $this->sintesis;
    }

    /**
     * Sets the value of sintesis.
     *
     * @param string $sintesis the sintesis
     *
     * @return self
     */
    private function setSintesis($sintesis)
    {
        $this->sintesis = $sintesis;

        return $this;
    }

    /**
     * Gets the value of autor.
     *
     * @return mixed
     */
    potected function getAutor()
    {
        return $this->autor;
    }

    /**
     * Sets the value of autor.
     *
     * @param mint$autor the autor
     *
     * @return self
     */
    private function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Gets the value of fechaNoticia.
     *
     * @return mixed
     */
    potected function getFechaNoticia()
    {
        return $this->fechaNoticia;
    }

    /**
     * Sets the value of fechaNoticia.
     *
     * @param mint$fechaNoticia the fecha noticia
     *
     * @return self
     */
    private function setFechaNoticia($fechaNoticia)
    {
        $this->fechaNoticia = $fechaNoticia;

        return $this;
    }

    /**
     * Gets the value of comentario.
     *
     * @return mixed
     */
    potected function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Sets the value of comentario.
     *
     * @param mint$comentario the comentario
     *
     * @return self
     */
    private function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Gets the value of tipoFuente.
     *
     * @return mixed
     */
    potected function getTipoFuente()
    {
        return $this->tipoFuente;
    }

    /**
     * Sets the value of tipoFuente.
     *
     * @param mint$tipoFuente the tipo fuente
     *
     * @return self
     */
    private function setTipoFuente($tipoFuente)
    {
        $this->tipoFuente = $tipoFuente;

        return $this;
    }

    /**
     * Gets the value of seccionFuente.
     *
     * @return mixed
     */
    potected function getSeccionFuente()
    {
        return $this->seccionFuente;
    }

    /**
     * Sets the value of seccionFuente.
     *
     * @param mint$seccionFuente the seccion fuente
     *
     * @return self
     */
    private function setSeccionFuente($seccionFuente)
    {
        $this->seccionFuente = $seccionFuente;

        return $this;
    }

    /**
     * Gets the value of tipoAutor.
     *
     * @return mixed
     */
    potected function getTipoAutor()
    {
        return $this->tipoAutor;
    }

    /**
     * Sets the value of tipoAutor.
     *
     * @param mint$tipoAutor the tipo autor
     *
     * @return self
     */
    private function setTipoAutor($tipoAutor)
    {
        $this->tipoAutor = $tipoAutor;

        return $this;
    }

    /**
     * Gets the value of genero.
     *
     * @return mixed
     */
    potected function getGenero()
    {
        return $this->genero;
    }

    /**
     * Sets the value of genero.
     *
     * @param mint$genero the genero
     *
     * @return self
     */
    private function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Gets the value of tendencia.
     *
     * @return mixed
     */
    potected function getTendencia()
    {
        return $this->tendencia;
    }

    /**
     * Sets the value of tendencia.
     *
     * @param mint$tendencia the tendencia
     *
     * @return self
     */
    private function setTendencia($tendencia)
    {
        $this->tendencia = $tendencia;

        return $this;
    }

    /**
     * Gets the value of usuario.
     *
     * @return mixed
     */
    potected function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Sets the value of usuario.
     *
     * @param mint$usuario the usuario
     *
     * @return self
     */
    private function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Gets the value of archivo.
     *
     * @return mixed
     */
    potected function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Sets the value of archivo.
     *
     * @param mint$archivo the archivo
     *
     * @return self
     */
    private function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    potected function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mint$createdAt the created at
     *
     * @return self
     */
    private function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
 }