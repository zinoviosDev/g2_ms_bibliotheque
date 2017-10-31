<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente une oeuvre empruntable de type DVD
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="dvd")
 */
class DVD extends Oeuvre {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
	/**
	 * AttributeType int
	 * représente la durée du DVD en minutes
	 * @ORM\Column(type="datetime", name="duree")
	 */
	private $duree;
	
	/**
	 * AttributeType text
	 * @ORM\Column(type="text", name="contenu")
	 */
	private $contenu = null;
	
	/**
	 * AttributeType string
	 * Décrit le type de DVD
	 * @ORM\Column(type="string", name="TYPE_DVD")
	 */
	private $type = null;

    

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
     * Set duree
     *
     * @param \DateTime $duree
     *
     * @return DVD
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return DVD
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return DVD
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
