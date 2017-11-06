<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Classe association représentant l'emprunt d'un livre par un adhérent
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="emprunt")
 */
class Emprunt {
    
	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
	 * @ORM\Column(type="datetime", name="date_emprunt")
	 */
	private $dateEmprunt = null;
	
	/**
	 * @ORM\Column(type="datetime", name="date_retour_theorique")
	 */
	private $dateRetourTheorique = null;
	
	/**
	 * @ORM\Column(type="datetime", name="date_retour_reelle")
	 */
	private $dateRetourReelle = null;
	
	/**
	 * @ORM\Column(type="integer", name="nombre_avertissements")
	 */
	private $nbreAvertissements = 0;
	
	/**
	 * AssociationType model.Adherent (Many To One, Unidirectional)
	 * AssociationMultiplicity 0..*
	 * @ORM\ManyToOne(targetEntity="Adherent", inversedBy="adherentEmprunts")
	 * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id")
	 */
	private $adherent;
	
	/**
	 * AssociationType model.Oeuvre (Many To One, Unidirectional)
	 * AssociationMultiplicity 0..*
	 * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="emprunts")
	 * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
	 */
	private $oeuvre;
	
	/**
	 * @ORM\ManyToOne(targetEntity="MS\GestionBibliothequeBundle\Entity\Exemplaire", inversedBy="emprunts")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $exemplaire;

    

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
     * Set dateEmprunt
     *
     * @param \DateTime $dateEmprunt
     *
     * @return Emprunt
     */
    public function setDateEmprunt($dateEmprunt)
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    /**
     * Get dateEmprunt
     *
     * @return \DateTime
     */
    public function getDateEmprunt()
    {
        return $this->dateEmprunt;
    }

    /**
     * Set dateRetourTheorique
     *
     * @param \DateTime $dateRetourTheorique
     *
     * @return Emprunt
     */
    public function setDateRetourTheorique($dateRetourTheorique)
    {
        $this->dateRetourTheorique = $dateRetourTheorique;

        return $this;
    }

    /**
     * Get dateRetourTheorique
     *
     * @return \DateTime
     */
    public function getDateRetourTheorique()
    {
        return $this->dateRetourTheorique;
    }

    /**
     * Set dateRetourReelle
     *
     * @param \DateTime $dateRetourReelle
     *
     * @return Emprunt
     */
    public function setDateRetourReelle($dateRetourReelle)
    {
        $this->dateRetourReelle = $dateRetourReelle;

        return $this;
    }

    /**
     * Get dateRetourReelle
     *
     * @return \DateTime
     */
    public function getDateRetourReelle()
    {
        return $this->dateRetourReelle;
    }

    /**
     * Set nbreAvertissements
     *
     * @param integer $nbreAvertissements
     *
     * @return Emprunt
     */
    public function setNbreAvertissements($nbreAvertissements)
    {
        $this->nbreAvertissements = $nbreAvertissements;

        return $this;
    }

    /**
     * Get nbreAvertissements
     *
     * @return integer
     */
    public function getNbreAvertissements()
    {
        return $this->nbreAvertissements;
    }

    /**
     * Set adherent
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adherent $adherent
     *
     * @return Emprunt
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
     * @return Emprunt
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
     * Set exemplaire
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Exemplaire $exemplaire
     *
     * @return Emprunt
     */
    public function setExemplaire(\MS\GestionBibliothequeBundle\Entity\Exemplaire $exemplaire)
    {
        $this->exemplaire = $exemplaire;

        return $this;
    }

    /**
     * Get exemplaire
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Exemplaire
     */
    public function getExemplaire()
    {
        return $this->exemplaire;
    }
}
