<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Classe association représentant la réservation d'une oeuvre par un adhérent
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="reservation")
 */
class Reservation extends AbstractEntity {
    
	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_demande_reservation")
	 */
	private $dateDemandeReservation = null;
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_annulation_reservation")
	 */
	private $dateAnnulationReservation = null;
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_reservation")
	 */
	private $dateReservation = null;
	
	/**
	 * AssociationType model.Adherent
	 * AssociationMultiplicity 0..*
	 * @ORM\ManyToOne(targetEntity="Adherent", inversedBy="adherentReservations")
	 * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id")
	 */
	private $adherent;
	
	/**
	 * AssociationType model.Oeuvre
	 * AssociationMultiplicity 0..*
	 * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="reservations")
	 * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
	 */
	private $oeuvre;

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
     * Set dateDemandeReservation
     *
     * @param \DateTime $dateDemandeReservation
     *
     * @return Reservation
     */
    public function setDateDemandeReservation($dateDemandeReservation)
    {
        $this->dateDemandeReservation = $dateDemandeReservation;

        return $this;
    }

    /**
     * Get dateDemandeReservation
     *
     * @return \DateTime
     */
    public function getDateDemandeReservation()
    {
        return $this->dateDemandeReservation;
    }

    /**
     * Set dateAnnulationReservation
     *
     * @param \DateTime $dateAnnulationReservation
     *
     * @return Reservation
     */
    public function setDateAnnulationReservation($dateAnnulationReservation)
    {
        $this->dateAnnulationReservation = $dateAnnulationReservation;

        return $this;
    }

    /**
     * Get dateAnnulationReservation
     *
     * @return \DateTime
     */
    public function getDateAnnulationReservation()
    {
        return $this->dateAnnulationReservation;
    }

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set adherent
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adherent $adherent
     *
     * @return Reservation
     */
    public function setAdherent(\MS\GestionBibliothequeBundle\Entity\Adherent $adherent = null)
    {
        $this->adherent = $adherent;

        return $this;
    }

    /**
     * Get adherent
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Adherent
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Set oeuvre
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre
     *
     * @return Reservation
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
}
