<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Représente l'Auteur (ou un des Auteur) d'une Oeuvre
 * @access public
 * @author marc
 * @package model
 * 
 * @ORM\Entity
 * @ORM\Table(name="auteur")
 */
class Auteur extends Personne {
    
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="nom")
	 */
	private $nom = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="prenom")
	 */
	private $prenom = null;
	
	/**
	 * @ORM\Column(type="string", name="genre")
	 * @var string
	 */
	private $genre = null;
	
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_naissance")
	 */
	private $dateNaissance = null;
	
	/**
	 * Many Auteur have Many Oeuvre ( Many-To-Many, Unidirectional)
	 * AssociationType model.Oeuvre
	 * AssociationMultiplicity *..*
	 * @ORM\OneToMany(targetEntity="Oeuvre", mappedBy="auteur", cascade={"persist"})
	 */
	private $oeuvres;
	

    public function __construct() {
	    $this->oeuvres = new ArrayCollection();
	}

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Auteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Auteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Auteur
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Auteur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Add oeuvre
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre
     *
     * @return Auteur
     */
    public function addOeuvre(\MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre)
    {
        $this->oeuvres[] = $oeuvre;

        return $this;
    }

    /**
     * Remove oeuvre
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre
     */
    public function removeOeuvre(\MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre)
    {
        $this->oeuvres->removeElement($oeuvre);
    }

    /**
     * Get oeuvres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }
    
    /**
     * @param field_type $oeuvres
     */
    public function setOeuvres($oeuvres)
    {
        $this->oeuvres = $oeuvres;
    }
}
