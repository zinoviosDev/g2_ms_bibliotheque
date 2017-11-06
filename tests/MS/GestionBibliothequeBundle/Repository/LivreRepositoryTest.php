<?php
namespace tests\MS\GestionBibliothequeBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use MS\GestionBibliothequeBundle\Entity\Livre;

class LivreRepositoryTest extends KernelTestCase {
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();
        
        $this->em = $kernel->getContainer()
        ->get('doctrine')
        ->getManager();
    }
    
    public function testFindAll()
    {
        $livres = $this->em
        ->getRepository(Livre::class)
        ->findAll()
        ;
        
        $this->assertCount(500, $livres);
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

