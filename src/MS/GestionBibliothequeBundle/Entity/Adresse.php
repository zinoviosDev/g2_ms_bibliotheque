<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente une adresse postale d'une Personne (physique ou morale) ou d'un Exemplaire
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity
 * @ORM\Table(name="adresse")
 */
class Adresse extends AbstractEntity {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer", name="numero")
     */
    private $numero = 0;
    
    /**
     * @ORM\Column(type="string", name="libelle_voie")
     */
    private $libelleVoie = null;
    
    /**
     * @ORM\Column(type="integer", name="code_postal")
     */
    private $codePostal = 0;
    
    /**
     * @ORM\Column(type="string", name="ville")
     */
    private $ville = null;
    
    /**
     * Many Adresses can be attached to One Personne (Unidirectional with Join Table)
     * @ORM\ManyToOne(targetEntity="Personne", inversedBy="adresses", cascade={"persist"})
     */
    private $personne = null;
    
    /**
     * One Adresse can be attached to one Exemplaire (mapped by Exemplaire)
     */
    private $exemplaire = null;
    
    
    
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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Adresse
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
        
        return $this;
    }
    
    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }
    
    /**
     * Set libelleVoie
     *
     * @param string $libelleVoie
     *
     * @return Adresse
     */
    public function setLibelleVoie($libelleVoie)
    {
        $this->libelleVoie = $libelleVoie;
        
        return $this;
    }
    
    /**
     * Get libelleVoie
     *
     * @return string
     */
    public function getLibelleVoie()
    {
        return $this->libelleVoie;
    }
    
    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Adresse
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
        
        return $this;
    }
    
    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }
    
    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        
        return $this;
    }
    
    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
    
    /**
     * Set personne
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Personne $personne
     *
     * @return Adresse
     */
    public function setPersonne(\MS\GestionBibliothequeBundle\Entity\Personne $personne = null)
    {
        $this->personne = $personne;
        
        return $this;
    }
    
    /**
     * Get personne
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }
}
