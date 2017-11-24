<?php
namespace MS\GestionBibliothequeBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use MS\GestionBibliothequeBundle\Entity\Adherent;

class AdherentRepositoryTest extends KernelTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    protected function setUp()
    {
        $kernel = self::bootKernel();
        
        $this->em = $kernel->getContainer()
        ->get('doctrine')
        ->getManager();
    }
    
    public function testFindAllAdherents()
    {
        $adherents = $this->em
        ->getRepository(Adherent::class)
        ->findAll()
        ;
        $this->assertCount(104, $adherents);
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        
        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}

