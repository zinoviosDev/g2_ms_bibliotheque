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
 * @ORM\DiscriminatorColumn(name="discr", type="string")
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
     * Add adress
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adress
     *
     * @return Personne
     */
    public function addAdress(\MS\GestionBibliothequeBundle\Entity\Adresse $adress)
    {
        $this->adresses[] = $adress;

        return $this;
    }

    /**
     * Remove adress
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adresse $adress
     */
    public function removeAdress(\MS\GestionBibliothequeBundle\Entity\Adresse $adress)
    {
        $this->adresses->removeElement($adress);
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
}
