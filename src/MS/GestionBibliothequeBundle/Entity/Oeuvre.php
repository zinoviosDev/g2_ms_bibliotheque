<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Classe abstraite représentant tout type de document empruntable en bibliothèque
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="oeuvre")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="DISCR", type="string")
 * @ORM\DiscriminatorMap({"livre" = "Livre", "dvd" = "DVD" })
 */
abstract class Oeuvre extends AbstractEntity {
    
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
	 * Titre de l'oeuvre
	 * @ORM\Column(type="string", name="titre")
	 */
	private $titre = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="sujet")
	 */
	private $sujet = null;
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_publication")
	 */
	private $dateDePublication = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="fonds_specifique", nullable=true)
	 */
	private $fondsSpecifique = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="langue")
	 */
	private $langue = null;
	
	/**
	 * One Editeur has Many Oeuvre (One To Many, Bidirectional)
	 * AssociationType model.Editeur
	 * AssociationMultiplicity 1
	 * @ORM\ManyToOne(targetEntity="Editeur", inversedBy="oeuvres")
	 * @ORM\JoinColumn(name="editeur_id", referencedColumnName="id")
	 */
	private $editeur;
	
	/**
	 * AssociationType model.Auteur
	 * AssociationMultiplicity *..*
	 * @ORM\ManyToOne(targetEntity="Auteur", inversedBy="oeuvres")
	 * @ORM\JoinColumn(name="auteur_id", referencedColumnName="id")
	 */
	private $auteur;

	/**
	 * AssociationType model.Exemplaire (One To Many, bidirectional)
	 * AssociationMultiplicity *
	 * @ORM\OneToMany(targetEntity="Exemplaire", mappedBy="oeuvre", cascade={"persist"})
	 */
	private $exemplaires;
	
	/**
	 * AssociationType model.Commentaire
	 * AssociationMultiplicity *
	 * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="commentaireOeuvre", cascade={"persist"})
	 */
	private $commentaires = array();
	
    public function __construct() {
	    $this->exemplaires = new ArrayCollection();
	    $this->commentaires = new ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Oeuvre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    
    public function titre() {
        return $this->titre;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return Oeuvre
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set dateDePublication
     *
     * @param \DateTime $dateDePublication
     *
     * @return Oeuvre
     */
    public function setDateDePublication($dateDePublication)
    {
        $this->dateDePublication = $dateDePublication;

        return $this;
    }

    /**
     * Get dateDePublication
     *
     * @return \DateTime
     */
    public function getDateDePublication()
    {
        return $this->dateDePublication;
    }

    /**
     * Set fondsSpecifique
     *
     * @param string $fondsSpecifique
     *
     * @return Oeuvre
     */
    public function setFondsSpecifique($fondsSpecifique)
    {
        $this->fondsSpecifique = $fondsSpecifique;

        return $this;
    }

    /**
     * Get fondsSpecifique
     *
     * @return string
     */
    public function getFondsSpecifique()
    {
        return $this->fondsSpecifique;
    }

    /**
     * Set langue
     *
     * @param string $langue
     *
     * @return Oeuvre
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set editeur
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Editeur $editeur
     *
     * @return Oeuvre
     */
    public function setEditeur(\MS\GestionBibliothequeBundle\Entity\Editeur $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Editeur
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set auteur
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Auteur $auteur
     *
     * @return Oeuvre
     */
    public function setAuteur(\MS\GestionBibliothequeBundle\Entity\Auteur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Auteur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Add exemplaire
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Exemplaire $exemplaire
     *
     * @return Oeuvre
     */
    public function addExemplaire(\MS\GestionBibliothequeBundle\Entity\Exemplaire $exemplaire)
    {
        $this->exemplaires[] = $exemplaire;

        return $this;
    }

    /**
     * Remove exemplaire
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Exemplaire $exemplaire
     */
    public function removeExemplaire(\MS\GestionBibliothequeBundle\Entity\Exemplaire $exemplaire)
    {
        $this->exemplaires->removeElement($exemplaire);
    }

    /**
     * Get exemplaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExemplaires()
    {
        return $this->exemplaires;
    }

    /**
     * Add commentaire
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Commentaire $commentaire
     *
     * @return Oeuvre
     */
    public function addCommentaire(\MS\GestionBibliothequeBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\MS\GestionBibliothequeBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
