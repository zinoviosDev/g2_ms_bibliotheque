<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente la carte de bibliothèque d'un adhérent
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="carte_bibliotheque")
 */
class CarteBibliotheque {
    
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
	 * @ORM\Column(type="string", name="numero_carte")
	 */
	private $numeroCarte = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="MOT_DE_PASSE")
	 */
	private $motDePasse = null;
	
	/**
	 * One CarteBibliotheque is owned by One Adherent (OneToOne, bidirectional)
	 * @var Adherent
	 * @ORM\OneToOne(targetEntity="Adherent", inversedBy="carteBibliotheque")
	 * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id")
	 */
	private $adherent = null;


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
     * Set numeroCarte
     *
     * @param string $numeroCarte
     *
     * @return CarteBibliotheque
     */
    public function setNumeroCarte($numeroCarte)
    {
        $this->numeroCarte = $numeroCarte;

        return $this;
    }

    /**
     * Get numeroCarte
     *
     * @return string
     */
    public function getNumeroCarte()
    {
        return $this->numeroCarte;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     *
     * @return CarteBibliotheque
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set adherent
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Adherent $adherent
     *
     * @return CarteBibliotheque
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
}
