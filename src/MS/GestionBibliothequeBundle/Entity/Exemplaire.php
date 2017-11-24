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
 * @ORM\Entity(repositoryClass="MS\GestionBibliothequeBundle\Repository\ExemplaireRepository")
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
	 * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="exemplaires")
	 * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id", nullable=false)
	 */
	private $oeuvre;
	
	/**
	 * AssociationType model.Adresse (One To One)
	 * AssociationMultiplicity 1..1
	 * @ORM\ManyToOne(targetEntity="Adresse")
	 * @ORM\JoinColumn(name="adresse_id", referencedColumnName="id", nullable=false)
	 */
	private $adresse;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $etat = self::ETAT_NEUF;
	
    
	/**
	 * @ORM\OneToMany(targetEntity="MS\GestionBibliothequeBundle\Entity\Emprunt", mappedBy="exemplaire")
	 */
    private $emprunts;
    
    /**
    * @ORM\OneToMany(targetEntity="MS\GestionBibliothequeBundle\Entity\Reservation", mappedBy="exemplaire")
    */
    private $reservations;
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emprunts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

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
    public function setOeuvre(\MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre)
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
     * Add emprunt
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt
     *
     * @return Exemplaire
     */
    public function addEmprunt(\MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt)
    {
        $this->emprunts[] = $emprunt;

        return $this;
    }

    /**
     * Remove emprunt
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt
     */
    public function removeEmprunt(\MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt)
    {
        $this->emprunts->removeElement($emprunt);
    }

    /**
     * Get emprunts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmprunts()
    {
        return $this->emprunts;
    }

    /**
     * Add reservation
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Reservation $reservation
     *
     * @return Exemplaire
     */
    public function addReservation(\MS\GestionBibliothequeBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\MS\GestionBibliothequeBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
