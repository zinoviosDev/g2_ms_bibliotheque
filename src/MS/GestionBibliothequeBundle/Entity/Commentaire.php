<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use DateTime;

/**
 * Représente un commentaire rédigé par un adhérent sur le site
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="commentaire")
 */
class Commentaire {
	
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
	 * @ORM\Column(type="string", name="titre")
	 */
	private $titre = null;
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_publication")
	 */
	private $datePublication = null;
	
	/**
	 * AttributeType DateTime
	 * @ORM\Column(type="datetime", name="date_modification")
	 */
	private $dateModification = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="text", name="contenu")
	 */
	private $contenu = null;
	
	/**
	 * Many Commentaire are written by One Adherent
	 * AssociationType model.Adherent
	 * AssociationMultiplicity 0 to Many
	 * @ORM\ManyToOne(targetEntity="Adherent", inversedBy="commentaires")
	 * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id")
	 */
	private $commentaireAdherent;
	
	/**
	 * AssociationType model.Oeuvre
	 * AssociationMultiplicity 0 to Many
	 * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="commentairesOeuvre")
	 * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
	 */
	public $commentaireOeuvre;

	

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
     * @return Commentaire
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

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Commentaire
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Commentaire
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
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
     * Set commentaireAdherent
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adherent $commentaireAdherent
     *
     * @return Commentaire
     */
    public function setCommentaireAdherent(\MS\GestionBibliothequeBundle\Entity\Adherent $commentaireAdherent = null)
    {
        $this->commentaireAdherent = $commentaireAdherent;

        return $this;
    }

    /**
     * Get commentaireAdherent
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Adherent
     */
    public function getCommentaireAdherent()
    {
        return $this->commentaireAdherent;
    }

    /**
     * Set commentaireOeuvre
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Oeuvre $commentaireOeuvre
     *
     * @return Commentaire
     */
    public function setCommentaireOeuvre(\MS\GestionBibliothequeBundle\Entity\Oeuvre $commentaireOeuvre = null)
    {
        $this->commentaireOeuvre = $commentaireOeuvre;

        return $this;
    }

    /**
     * Get commentaireOeuvre
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Oeuvre
     */
    public function getCommentaireOeuvre()
    {
        return $this->commentaireOeuvre;
    }
}
