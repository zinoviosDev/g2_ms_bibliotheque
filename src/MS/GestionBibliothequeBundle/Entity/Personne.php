<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Classe abstraite caractérisant une personne
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="personne")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="DISCR", type="string")
 * @ORM\DiscriminatorMap({"adherent" = "Adherent", "auteur" = "Auteur", "editeur" = "Editeur" })
 */
abstract class Personne  extends AbstractEntity {
    
	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
	 * One Personne has Many Adresse (Unidirectional with Join Table)
	 * AssociationType model.Adresse
	 * AssociationMultiplicity 1..*
	 * @ORM\OneToMany(targetEntity="Adresse", mappedBy="personne", cascade={"persist"})
	 */
	private $adresses;
	
	public function __construct() {
	    $this->adresses = new ArrayCollection();
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
     * Add adresses
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adresses
     *
     * @return Personne
     */
    public function addAdresses(\MS\GestionBibliothequeBundle\Entity\Adresse $adresses)
    {
        $this->adresses[] = $adresses;

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adresses
     */
    public function removeAdresses(\MS\GestionBibliothequeBundle\Entity\Adresse $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresses()
    {
        return $this->adresses;
    }
    
    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $adresses
     */
    public function setAdresses($adresses)
    {
        $this->adresses = $adresses;
    }
}
