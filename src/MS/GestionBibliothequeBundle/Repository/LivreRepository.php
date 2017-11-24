<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\Livre;

class LivreRepository extends EntityRepository {
    
    public function findByDatePublication(int $limit) {
        $qb = $this->createQueryBuilder('l')->join('l.exemplaires', 'e');
        $qb->select('l')->distinct(true);
        $qb->addOrderBy('l.dateDePublication', 'DESC');
        $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
    
    /**
     * @param Livre $livre
     * @return array
     */
    public function findByMultiCriteres(Livre $livre) {
        $qb = $this->createQueryBuilder('l')->join('l.auteur', 'a')->join('l.exemplaires', 'e');
        if($livre->getIsbn()) {
            $qb->andWhere('l.isbn = :isbn')->setParameter('isbn', $livre->getIsbn());
        }
        if($livre->getTitre()) {
            $qb->andWhere('l.titre LIKE :titre')->setParameter('titre', '%'.$livre->getTitre().'%');
        }
        if(null != $livre->getAuteur() && $livre->getAuteur()->getNom()) {
            $qb->andWhere('a.nom LIKE :nom')->setParameter('nom', '%'.$livre->getAuteur()->getNom().'%');
        }
        if(null != $livre->getAuteur() && $livre->getAuteur()->getPrenom()) {
            $qb->andWhere('a.prenom LIKE :prenom')->setParameter('prenom', '%'.$livre->getAuteur()->getPrenom().'%');
        }
        $qb->andWhere('e.oeuvre = l');
        $qb->addOrderBy('l.dateDePublication', 'DESC');
        return $qb->getQuery()->getResult();
    }
}

