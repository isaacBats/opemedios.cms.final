<?php 

class Page{
	
	private $id;

	private $titulo;

	private $title;

	private $slug;

	private $contenido;

	private $contend;

	private $imagen;

	private $fecha;


	/**
	 * Class Constructor
	 * @param    $titulo   
	 */
	public function __construct($titulo)
	{
		$this->titulo = $titulo;
	}


	/**
	 * Class new page
	 * @param    $id   
	 * @param    $titulo   
	 * @param    $title   
	 * @param    $slug   
	 * @param    $contenido   
	 * @param    $contend   
	 * @param    $imagen   
	 * @param    $fecha   
	 */
	public function newPage($id, $titulo, $title, $slug, $contenido, $contend, $imagen, $fecha)
	{
		$this->id = $id;
		$this->titulo = $titulo;
		$this->title = $title;
		$this->slug = $slug;
		$this->contenido = $contenido;
		$this->contend = $contend;
		$this->imagen = $imagen;
		$this->fecha = $fecha;
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
    private function setId($id)
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
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the value of slug.
     *
     * @param mixed $slug the slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Gets the value of contenido.
     *
     * @return mixed
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Sets the value of contenido.
     *
     * @param mixed $contenido the contenido
     *
     * @return self
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Gets the value of contend.
     *
     * @return mixed
     */
    public function getContend()
    {
        return $this->contend;
    }

    /**
     * Sets the value of contend.
     *
     * @param mixed $contend the contend
     *
     * @return self
     */
    public function setContend($contend)
    {
        $this->contend = $contend;

        return $this;
    }

    /**
     * Gets the value of imagen.
     *
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Sets the value of imagen.
     *
     * @param mixed $imagen the imagen
     *
     * @return self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Gets the value of fecha.
     *
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Sets the value of fecha.
     *
     * @param mixed $fecha the fecha
     *
     * @return self
     */
    private function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}