<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

require_once 'Personne.php';

/**
 * @access public
 * @author marc
 * @package model
 * 
 * @ORM\Entity 
 * @ORM\Table(name="editeur")
 */
class Editeur extends Personne {
    
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
	 * @ORM\Column(type="string", name="sigle")
	 */
	private $sigle = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="raison_sociale")
	 */
	private $raisonSociale = null;
	
	/**
	 * One Editeur has Many Oeuvre (One to Many, Bidirectionnal)
	 * AssociationType model.Oeuvre
	 * AssociationMultiplicity 1..*
	 * @ORM\OneToMany(targetEntity="Oeuvre", mappedBy="editeur")
	 */
	 private $oeuvres;
	 
	 public function __construct() {
	     $this->oeuvres = new ArrayCollection();
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
     * Set sigle
     *
     * @param string $sigle
     *
     * @return Editeur
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;

        return $this;
    }

    /**
     * Get sigle
     *
     * @return string
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     *
     * @return Editeur
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Add oeuvre
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Oeuvre $oeuvre
     *
     * @return Editeur
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
}
