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
    
    public const DUREE_LIMITE_EMPRUNT= 15;
    
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
     * @ORM\Column(name="nbreEmpruntsAutorises", type="integer")
     */
    private $nbreEmpruntsAutorises = 10;
    
    /**
     * @ORM\Column(name="nbreReservationsAutorisees", type="integer")
     */
    private $nbreReservationsAutorisees = 10;

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
     * @ORM\OneToMany(targetEntity="Emprunt", mappedBy="adherent")
     * @var array
     */
    private $emprunts;
    
    /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="adherent")
     * @var array
     */
    private $reservations;
    
    /**
     * AttributeType string
     * @ORM\Column(type="string", name="numero_carte")
     */
    private $numCarte;
    
    /**
     * @var User
     * @ORM\OneToOne(targetEntity="MS\UserBundle\Entity\User", cascade={"persist"})
     */
    private $userCredentials;

    /**
     * @return the $numCarte
     */
    public function getNumCarte()
    {
        return $this->numCarte;
    }

    /**
     * @param field_type $numCarte
     */
    public function setNumCarte($numCarte)
    {
        $this->numCarte = $numCarte;
    }

    public function __construct() {
        $this->commentaires = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
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
     * Set nbreEmpruntsAutorises
     *
     * @param integer $nbreEmpruntsAutorises
     *
     * @return Adherent
     */
    public function setNbreEmpruntsAutorises($nbreEmpruntsAutorises)
    {
        $this->nbreEmpruntsAutorises = $nbreEmpruntsAutorises;

        return $this;
    }

    /**
     * Get nbreEmpruntsAutorises
     *
     * @return integer
     */
    public function getNbreEmpruntsAutorises()
    {
        return $this->nbreEmpruntsAutorises;
    }

    /**
     * Set nbreReservationsAutorisees
     *
     * @param integer $nbreReservationsAutorisees
     *
     * @return Adherent
     */
    public function setNbreReservationsAutorisees($nbreReservationsAutorisees)
    {
        $this->nbreReservationsAutorisees = $nbreReservationsAutorisees;

        return $this;
    }

    /**
     * Get nbreReservationsAutorisees
     *
     * @return integer
     */
    public function getNbreReservationsAutorisees()
    {
        return $this->nbreReservationsAutorisees;
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
     * Add emprunt
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt
     *
     * @return Adherent
     */
    public function addEmprunt(\MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt)
    {
        $this->emprunts[] = $emprunt;

        return $this;
    }

    /**
     * Remove emprunt
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt
     */
    public function removeEmprunt(\MS\GestionBibliothequeBundle\Entity\Emprunt $emprunt)
    {
        $this->emprunts->removeElement($emprunt);
    }

    /**
     * Get emprunts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmprunts()
    {
        return $this->emprunts;
    }

    /**
     * Add reservation
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Reservation $reservation
     *
     * @return Adherent
     */
    public function addReservation(\MS\GestionBibliothequeBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\MS\GestionBibliothequeBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Set userCredentials
     *
     * @param \MS\UserBundle\Entity\User $userCredentials
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
