<?php namespace MS\GestionBibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dummy
 * @access public
 * @author marc
 * @package model
 * @ORM\Entity
 * @ORM\Table(name="dummy")
 */
class Dummy {
    
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
     * One Dummy has One Dummy.
     * @ORM\OneToOne(targetEntity="DummyRelated", cascade={"persist"})
     */
    private $dummyRelated = null;
    
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
     * @return the $dummyRelated
     */
    public function getDummyRelated()
    {
        return $this->dummyRelated;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param field_type $dummyRelated
     */
    public function setDummyRelated($dummyRelated)
    {
        $this->dummyRelated = $dummyRelated;
    }

    
}
