<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Représente un exemplaire d'une oeuvre
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="exemplaire")
 */
class Exemplaire extends AbstractEntity {
    
    const ETAT_NEUF = 0;
    const ETAT_MOYEN = 1;
    const ETAT_DEGRADE= 2;
    
    const ACCES_EMPRUNT = 0;
    const ACCES_CONSULTATION_SUR_PLACE = 1;
    
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
	 * @ORM\Column(type="integer", name="mode_acces")
	 */
    private $modeAcces = self::ACCES_EMPRUNT;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="cote")
	 */
	private $cote = null;
	
	/**
	 * AssociationType model.Oeuvre (Many To One, Unidirectional)
	 * AssociationMultiplicity 0..*
	 * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="oeuvre")
	 * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
	 */
	private $oeuvre;
	
	/**
	 * AssociationType model.Adresse (One To Many, bidirectional)
	 * AssociationMultiplicity 1..1
	 * @ORM\OneToOne(targetEntity="Adresse", cascade={"persist"})
	 */
	private $adresses;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $etat = self::ETAT_NEUF;
	
	

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
     * Set modeAcces
     *
     * @param integer $modeAcces
     *
     * @return Exemplaire
     */
    public function setModeAcces($modeAcces)
    {
        $this->modeAcces = $modeAcces;

        return $this;
    }

    /**
     * Get modeAcces
     *
     * @return integer
     */
    public function getModeAcces()
    {
        return $this->modeAcces;
    }

    /**
     * Set cote
     *
     * @param string $cote
     *
     * @return Exemplaire
     */
    public function setCote($cote)
    {
        $this->cote = $cote;

        return $this;
    }

    /**
     * Get cote
     *
     * @return string
     */
    public function getCote()
    {
        return $this->cote;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Exemplaire
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set oeuvre
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre
     *
     * @return Exemplaire
     */
    public function setOeuvre(\MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre = null)
    {
        $this->oeuvre = $oeuvre;

        return $this;
    }

    /**
     * Get oeuvre
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Oeuvre
     */
    public function getOeuvre()
    {
        return $this->oeuvre;
    }

    /**
     * Set adresses
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adresses
     *
     * @return Exemplaire
     */
    public function setAdresses(\MS\GestionBibliothequeBundle\Entity\Adresse $adresses = null)
    {
        $this->adresses = $adresses;

        return $this;
    }

    /**
     * Get adresses
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Adresse
     */
    public function getAdresses()
    {
        return $this->adresses;
    }
}
