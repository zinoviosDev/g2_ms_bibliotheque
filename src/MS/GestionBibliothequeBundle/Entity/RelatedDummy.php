<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dummy
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity
 * @ORM\Table(name="related_dummy")
 */
class RelatedDummy {
    
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
     * @ORM\Column(type="string")
     */
    private $name = null;
    
    /**
     * @ORM\ManyToOne(targetEntity="MS\GestionBibliothequeBundle\Entity\Dummy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dummy;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Set dummy
     *
     * @param \MS\GestionBibliothequeBundle\Entity\Dummy $dummy
     *
     * @return DummyRelated
     */
    public function setDummy(\MS\GestionBibliothequeBundle\Entity\Dummy $dummy)
    {
        $this->dummy = $dummy;

        return $this;
    }

    /**
     * Get dummy
     *
     * @return \MS\GestionBibliothequeBundle\Entity\Dummy
     */
    public function getDummy()
    {
        return $this->dummy;
    }
}
