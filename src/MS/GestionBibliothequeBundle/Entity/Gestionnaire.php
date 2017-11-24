<?php
namespace MS\GestionBibliothequeBundle\Entity;

use MS\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Gestionnaire
 *
 * @ORM\Table(name="gestionnaire")
 * @ORM\Entity(repositoryClass="MS\GestionBibliothequeBundle\Repository\GestionnaireRepository")
 */
class Gestionnaire extends Personne {
    
    /**
    * @var string
    *
    * @ORM\Column(name="nom", type="string", length=50)
    */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     */
    private $prenom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=10)
     */
    private $genre;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="datetime", nullable=true)
     */
    private $dateNaissance;
    
    /**
     * @var User
     * @ORM\OneToOne(targetEntity="MS\UserBundle\Entity\User", cascade={"persist"})
     */
    private $userCredentials;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Gestionnaire
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
     * @return Gestionnaire
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
     * @return Gestionnaire
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
     * @return Gestionnaire
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
     * Set userCredentials
     *
     * @param \MS\UserBundle\Entity\User $userCredentials
     *
     * @return Gestionnaire
     */
    public function setUserCredentials(\MS\UserBundle\Entity\User $userCredentials = null)
    {
        $this->userCredentials = $userCredentials;

        return $this;
    }

    /**
     * Get userCredentials
     *
     * @return \MS\UserBundle\Entity\User
     */
    public function getUserCredentials()
    {
        return $this->userCredentials;
    }
}
