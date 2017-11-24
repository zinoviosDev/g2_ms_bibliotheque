<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Représente une oeuvre empruntable de type livre
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity 
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="MS\GestionBibliothequeBundle\Repository\LivreRepository")
 */
class Livre extends Oeuvre {
    
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="isbn", unique=true, nullable=false)
	 */
	private $isbn;
	
	/**
	 * AttributeType int
	 * @ORM\Column(type="integer", name="nbre_pages")
	 */
	private $nbrePages = 0;
	
	/**
	 * AttributeType text
	 * @ORM\Column(type="text", name="description")
	 */
	private $description = null;
	
	/**
	 * AttributeType text
	 * @ORM\Column(type="text", name="resume")
	 */
	private $resume = null;
	
	/**
	 * AttributeType string
	 * @ORM\Column(type="string", name="format", nullable=true)
	 */
	private $format = null;

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Livre
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set nbrePages
     *
     * @param integer $nbrePages
     *
     * @return Livre
     */
    public function setNbrePages($nbrePages)
    {
        $this->nbrePages = $nbrePages;

        return $this;
    }

    /**
     * Get nbrePages
     *
     * @return integer
     */
    public function getNbrePages()
    {
        return $this->nbrePages;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Livre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Livre
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set format
     *
     * @param string $format
     *
     * @return Livre
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
    
//     public function isContentValid(ExecutionContextInterface $context) {
//         if (preg_match('#'.implode('|', $forbiddenWords).'#', $this->getContent())) {
//             // La règle est violée, on définit l'erreur
//             $context
//             ->buildViolation('Contenu invalide car il contient un mot interdit.') // message
//             ->atPath('content')                                                   // attribut de l'objet qui est violé
//             ->addViolation() // ceci déclenche l'erreur, ne l'oubliez pas
//             ;
//         }
//     }
}
