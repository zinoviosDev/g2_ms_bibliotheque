<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LivreRepository extends EntityRepository {
    
    public function findLivresByDatePublication(int $limit) {
        $qb = $this->createQueryBuilder('l');
//         $qb
//         ->where('l.id = :id')
//         ->setParameter('id', $id)
        $qb->addOrderBy('l.dateDePublication', 'DESC')
        ;
        $qb
        ->innerJoin('l.auteur', 'a')
        ->addSelect('a')
        ;
        
        // Puis on ne retourne que $limit résultats
        $qb->setMaxResults($limit);
        
        return $qb
        ->getQuery()
        ->getResult()
        ;
    }
      
}

