<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\DVD;

class DVDRepository extends EntityRepository {
    
    public function findByDatePublication(int $limit) {
        $qb = $this->createQueryBuilder('d');
        $qb->addOrderBy('d.dateDePublication', 'DESC');
        $qb->innerJoin('d.auteur', 'a')->addSelect('a');
        $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
    
    public function findByMultiCriteres(DVD $dvd) {
        $qb = $this->createQueryBuilder('d')
        ->innerJoin('d.auteur', 'a')
        ->addSelect('a')
        ;
        if($dvd->getTitre()) {
            $qb->andWhere('d.titre LIKE :titre')->setParameter('titre', '%'.$dvd->getTitre().'%');
        }
        if($dvd->getAuteur()->getNom()) {
            $qb->andWhere('a.nom LIKE :nom')->setParameter('nom', '%'.$dvd->getAuteur()->getNom().'%');
        }
        if($dvd->getAuteur()->getPrenom()) {
            $qb->andWhere('a.prenom LIKE :prenom')->setParameter('prenom', '%'.$dvd->getAuteur()->getPrenom().'%');
        }
        $qb->addOrderBy('d.dateDePublication', 'DESC');
        return $qb
        ->getQuery()
        ->getResult()
        ;
    }
}

