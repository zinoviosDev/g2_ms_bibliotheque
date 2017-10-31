<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente une oeuvre empruntable de type livre
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="livre")
 */
class Livre extends Oeuvre {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="isbn")
	 */
	private $isbn = null;
	
	/**
	 * AttributeType int
	 * @ORM\Column(type="integer", name="nbre_pages")
	 */
	private $nbrePages = 0;
	
	/**
	 * AttributeType text
	 * @ORM\Column(type="text", name="description")
	 */
	private $description = null;
	
	/**
	 * AttributeType text
	 * @ORM\Column(type="text", name="resume")
	 */
	private $resume = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="format", nullable=true)
	 */
	private $format = null;

	

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Livre
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set nbrePages
     *
     * @param integer $nbrePages
     *
     * @return Livre
     */
    public function setNbrePages($nbrePages)
    {
        $this->nbrePages = $nbrePages;

        return $this;
    }

    /**
     * Get nbrePages
     *
     * @return integer
     */
    public function getNbrePages()
    {
        return $this->nbrePages;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Livre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Livre
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set format
     *
     * @param string $format
     *
     * @return Livre
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
}
