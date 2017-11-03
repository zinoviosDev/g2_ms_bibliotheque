<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;

class DVDRepository extends EntityRepository {
    
    public function findDVDByDatePublication(int $limit) {
        $qb = $this->createQueryBuilder('d');
        $qb->addOrderBy('d.dateDePublication', 'DESC');
        $qb->innerJoin('d.auteur', 'a')->addSelect('a');
        $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
}

