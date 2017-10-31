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
	 * @ORM\ManyToMany(targetEntity="Adresse")
	 * @ORM\JoinTable(name="personnes_adresses",
	 *     joinColumns={@ORM\JoinColumn(name="personne_id", referencedColumnName="id")},
	 *     inverseJoinColumns={@ORM\JoinColumn(name="adresse_id", referencedColumnName="id", unique=true)}
	 *   )
	 */
	private $adressesPersonne;
	
	public function __construct() {
	    $this->adressesPersonne = new ArrayCollection();
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
     * Add adressesPersonne
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adressesPersonne
     *
     * @return Personne
     */
    public function addAdressesPersonne(\MS\GestionBibliothequeBundle\Entity\Adresse $adressesPersonne)
    {
        $this->adressesPersonne[] = $adressesPersonne;

        return $this;
    }

    /**
     * Remove adressesPersonne
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adressesPersonne
     */
    public function removeAdressesPersonne(\MS\GestionBibliothequeBundle\Entity\Adresse $adressesPersonne)
    {
        $this->adressesPersonne->removeElement($adressesPersonne);
    }

    /**
     * Get adressesPersonne
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdressesPersonne()
    {
        return $this->adressesPersonne;
    }
}
