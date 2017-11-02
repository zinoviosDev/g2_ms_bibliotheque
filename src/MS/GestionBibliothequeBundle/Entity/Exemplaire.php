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
class Exemplaire {
    
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
	 * AssociationMultiplicity 1..*
	 * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="oeuvre")
	 * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
	 */
	private $oeuvre;
	
	/**
	 * AssociationType model.Adresse (One To One)
	 * AssociationMultiplicity 1..1
	 * @ORM\OneToOne(targetEntity="MS\GestionBibliothequeBundle\Entity\Adresse", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $adresse;
	
	/**
	 * One Oeuvre has 0 or 1 Emprunt
	 * AssociationType model.Emprunt
	 * AssociationMultiplicity 1..1
	 * @ORM\OneToOne(targetEntity="Emprunt", cascade={"persist"})
	 */
	private $emprunt;
	
	/**
	 * AssociationType model.Reservation (One To One)
	 * AssociationMultiplicity 1..1
	 * @ORM\OneToOne(targetEntity="Reservation", cascade={"persist"})
	 */
	private $reservation;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $etat = self::ETAT_NEUF;
	
	
	public function __construct() {}

    

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
     * Set adresse
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adresse
     *
     * @return Exemplaire
     */
    public function setAdresse(\MS\GestionBibliothequeBundle\Entity\Adresse $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set emprunt
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt
     *
     * @return Exemplaire
     */
    public function setEmprunt(\MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt = null)
    {
        $this->emprunt = $emprunt;

        return $this;
    }

    /**
     * Get emprunt
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Emprunt
     */
    public function getEmprunt()
    {
        return $this->emprunt;
    }

    /**
     * Set reservation
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Reservation $reservation
     *
     * @return Exemplaire
     */
    public function setReservation(\MS\GestionBibliothequeBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
