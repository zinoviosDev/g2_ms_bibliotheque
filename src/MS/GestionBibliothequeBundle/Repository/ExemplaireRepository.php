<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\Exemplaire;

class ExemplaireRepository extends EntityRepository {
    
    /**
     * Un exemplaire est disponible si le dernier emprunt effectue sur cet exemplaire est échu
     * @param Exemplaire $exemplaire
     */
    public function findEmpruntsEchus(Exemplaire $exemplaire) {
        // retourne les emprunts échus à la date du jour
        $qb = $this->createQueryBuilder('ex');
        $qb->innerJoin('ex.emprunts', 'emp')->addSelect('emp');
        $qb->andWhere('emp.dateRetourReelle < :dateNow')->setParameter('dateNow', new \DateTime());
        $qb->addOrderBy('emp.dateRetourReelle', 'DESC');
        return $qb
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function findAllEmprunts() {
        $em=$this->getEntityManager();
        $query = $em->createQuery("SELECT ex, count(emp.id)" 
                        ."FROM MSGestionBibliothequeBundle:Exemplaire ex JOIN ex.emprunts emp "
                        ."GROUP BY ex.id");
        return $query->getResult()
        ;
    }
    
    public function empruntsEnCours(Exemplaire $exemplaire) {
        $qb = $this->createQueryBuilder('ex');
        $qb->innerJoin('ex.emprunts', 'emp')->addSelect('emp');
        $qb->andWhere('emp.dateRetourTheorique >= :dateNow')->setParameter('dateNow', new \DateTime());
        return $qb
        ->getQuery()
        ->getResult()
        ;
    }
}