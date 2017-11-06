<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\Livre;

class LivreRepository extends EntityRepository {
    
    public function findByDatePublication(int $limit) {
        $qb = $this->createQueryBuilder('l');
        $qb->addOrderBy('l.dateDePublication', 'DESC')
        ;
        $qb
        ->innerJoin('l.auteur', 'a')
        ->addSelect('a')
        ;
        
        // Puis on ne retourne que $limit résultats
        $qb->setMaxResults($limit);
        
        $livresTmp = $qb->getQuery()->getResult();
        // on ne renvoie que les livre qui ont des exemplaires
        $livres = array();
        foreach ($livresTmp as $l) {
            if(count($l->getExemplaires()) >= 1) {
                array_push($livres, $l);
            }
        }
        return $livres;
    }
    
    /**
     * TODO: look at this to filter by number of Exemplaire 
     * https://knpuniversity.com/screencast/doctrine-queries/select-sum
     * @param Livre $livre
     * @return array
     */
    public function findByMultiCriteres(Livre $livre) {
        $qb = $this->createQueryBuilder('l')
            ->innerJoin('l.auteur', 'a')
            ->addSelect('a')
        ;
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
        $qb->addOrderBy('l.dateDePublication', 'DESC');
        
        $livresTmp = $qb->getQuery()->getResult();
        // on ne renvoie que les livre qui ont des exemplaires
        $livres = array();
        foreach ($livresTmp as $l) {
            if(count($l->getExemplaires()) >= 1) {
                array_push($livres, $l);
            }
        }
        return $livres;
    }
    
//     public function findByMultiCriteresHavingExemplaires(Livre $livre) {
//         $sql = "SELECT o.id, o.titre, count(e.id) as nb_exemplaires FROM oeuvre as o,
//                  exemplaire as e
//                 WHERE o.id = e.oeuvre_id
//                 GROUP BY o.id
//                 HAVING nb_exemplaires >=1
//                 ";
//     }
      
}

