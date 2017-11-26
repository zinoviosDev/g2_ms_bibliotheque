<?php namespace MS\GestionBibliothequeBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author marc
 *        
 */
class ReservationRepositoryTest extends KernelTestCase
{
    
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

