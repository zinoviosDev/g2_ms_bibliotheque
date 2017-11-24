<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\DVD;

class DVDRepository extends EntityRepository {
    
    public function findByDatePublication(int $limit) {
        $qb = $this->createQueryBuilder('d')->join('d.auteur', 'a')->join('d.exemplaires', 'e');
        $qb->select('d')->distinct(true);
        $qb->addOrderBy('d.dateDePublication', 'DESC');
        $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
    

    public function findByMultiCriteres(DVD $dvd) {
        $qb = $this->createQueryBuilder('d')->join('d.auteur', 'a')->join('d.exemplaires', 'e');
        if($dvd->getTitre()) {
            $qb->andWhere('d.titre LIKE :titre')->setParameter('titre', '%'.$dvd->getTitre().'%');
        }
        if(null != $dvd->getAuteur() && $dvd->getAuteur()->getNom()) {
            $qb->andWhere('a.nom LIKE :nom')->setParameter('nom', '%'.$dvd->getAuteur()->getNom().'%');
        }
        if(null != $dvd->getAuteur() && $dvd->getAuteur()->getPrenom()) {
            $qb->andWhere('a.prenom LIKE :prenom')->setParameter('prenom', '%'.$dvd->getAuteur()->getPrenom().'%');
        }
        $qb->andWhere('e.oeuvre = d');
        $qb->addOrderBy('d.dateDePublication', 'DESC');
        return $qb->getQuery()->getResult();
    }
    
    public function countExemplaires(DVD $dvd) {
        $qb = $this->createQueryBuilder('d')->select('COUNT(d)');
        $qb->join('d.exemplaires', 'e');
        $qb->andWhere('d.id = :id')->setParameter('id', $dvd->getId());
        return $qb->getQuery()->getOneOrNullResult();
    }
}

