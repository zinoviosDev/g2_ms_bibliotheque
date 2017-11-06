<?php

namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use MS\UserBundle\Entity\User;

/**
 * Adherent
 *
 * @ORM\Table(name="adherent")
 * @ORM\Entity(repositoryClass="MS\GestionBibliothequeBundle\Repository\AdherentRepository")
 */
class Adherent extends Personne
{
    
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
     * @var int
     *
     * @ORM\Column(name="nbreEmpruntsAuthorises", type="integer")
     */
    private $nbreEmpruntsAuthorises;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="numTelephone", type="string", length=50, nullable=true)
     */
    private $numTelephone;
    
    /**
     * @var array
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="adherent", cascade={"persist"})
     */
    private $commentaires;
    
    /**
     * @var CarteBibliotheque
     * @ORM\OneToOne(targetEntity="MS\GestionBibliothequeBundle\Entity\CarteBibliotheque", cascade={"persist"})
     */
    private $carteBibliotheque;
    
    /**
     * @var User
     * @ORM\OneToOne(targetEntity="MS\UserBundle\Entity\User", inversedBy="adherent", cascade={"persist"})
     */
    private $userCredentials;

    public function __construct() {
        $this->commentaires = new ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Adherent
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
     * @return Adherent
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
     * @return Adherent
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
     * @return Adherent
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
     * Set nbreEmpruntsAuthorises
     *
     * @param integer $nbreEmpruntsAuthorises
     *
     * @return Adherent
     */
    public function setNbreEmpruntsAuthorises($nbreEmpruntsAuthorises)
    {
        $this->nbreEmpruntsAuthorises = $nbreEmpruntsAuthorises;

        return $this;
    }

    /**
     * Get nbreEmpruntsAuthorises
     *
     * @return integer
     */
    public function getNbreEmpruntsAuthorises()
    {
        return $this->nbreEmpruntsAuthorises;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Adherent
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set numTelephone
     *
     * @param string $numTelephone
     *
     * @return Adherent
     */
    public function setNumTelephone($numTelephone)
    {
        $this->numTelephone = $numTelephone;

        return $this;
    }

    /**
     * Get numTelephone
     *
     * @return string
     */
    public function getNumTelephone()
    {
        return $this->numTelephone;
    }

    /**
     * Add commentaire
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Commentaire $commentaire
     *
     * @return Adherent
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

    /**
     * Set carteBibliotheque
     *
     * @param \MS\GestionBibliothequeBundle\Entity\CarteBibliotheque $carteBibliotheque
     *
     * @return Adherent
     */
    public function setCarteBibliotheque(\MS\GestionBibliothequeBundle\Entity\CarteBibliotheque $carteBibliotheque = null)
    {
        $this->carteBibliotheque = $carteBibliotheque;

        return $this;
    }

    /**
     * Get carteBibliotheque
     *
     * @return \MS\GestionBibliothequeBundle\Entity\CarteBibliotheque
     */
    public function getCarteBibliotheque()
    {
        return $this->carteBibliotheque;
    }

    /**
     * Set userCredentials
     *
     * @param \MS\GestionBibliothequeBundle\Entity\User $userCredentials
     *
     * @return Adherent
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
