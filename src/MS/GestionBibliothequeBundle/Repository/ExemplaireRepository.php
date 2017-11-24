<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\Exemplaire;
use MS\GestionBibliothequeBundle\Entity\Reservation;

class ExemplaireRepository extends EntityRepository {
    
    /**
     * Un exemplaire est disponible si le dernier emprunt effectue sur cet exemplaire est échu
     * @param Exemplaire $exemplaire
     */
    public function countEmpruntsEchusForAll(Exemplaire $exemplaire) {
        // retourne les emprunts échus à la date du jour
        $qb = $this->createQueryBuilder('ex')->select('COUNT(ex)');
        $qb->join('ex.emprunts', 'emp');
        $qb->join('ex.oeuvre', 'o');
        $qb->andWhere('ex.oeuvre = :ex_oeuvre')->setParameter('ex_oeuvre', $exemplaire->getOeuvre());
        $qb->andWhere('emp.dateRetourReelle < :dateNow')->setParameter('dateNow', new \DateTime());
        return $qb
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    
    public function countAllEmpruntsForAll(Exemplaire $exemplaire) {
        $em=$this->getEntityManager();
        $query = $em->createQuery("select count(emp.id)" 
                        ."FROM MSGestionBibliothequeBundle:Exemplaire ex JOIN ex.emprunts emp JOIN ex.oeuvre o "
                        ."WHERE o.id = ?1 "
                        ."GROUP BY ex.id");
        $query->setParameter(1, $exemplaire->getOeuvre()->getId());
        return $query->getOneOrNullResult()
        ;
    }
    
    public function countEmpruntsEnCours(Exemplaire $exemplaire) {
        $qb = $this->createQueryBuilder('ex')->select('COUNT(ex)');
        $qb->join('ex.emprunts', 'emp');
        $qb->join('ex.oeuvre', 'o');
        $qb->andWhere('ex.id = :ex_id')->setParameter('ex_id', $exemplaire->getId());
        $qb->andWhere('ex.oeuvre = :ex_oeuvre')->setParameter('ex_oeuvre', $exemplaire->getOeuvre());
        $qb->andWhere('emp.dateRetourTheorique >= :dateNow')->setParameter('dateNow', new \DateTime());
        return $qb
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    
    public function countReservationsEnCours(Exemplaire $exemplaire) {
        $qb = $this->createQueryBuilder('ex');
        $qb->join('ex.reservations', 'res');
        $qb->join('ex.oeuvre', 'o');
        //TODO: fixer une date de fin de réservation
        $qb->andWhere('ex.id = :ex_id')->setParameter('ex_id', $exemplaire->getId());
        $qb->andWhere('ex.oeuvre = :ex_oeuvre')->setParameter('ex_oeuvre', $exemplaire->getOeuvre());
        $qb->andWhere('res.suiteReservation = :suiteRes')->setParameter('suiteRes', Reservation::SUITE_RESERVATION_RESERVE);
        return $qb
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
}