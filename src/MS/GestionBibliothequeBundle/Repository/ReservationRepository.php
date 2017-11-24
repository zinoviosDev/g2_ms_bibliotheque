<?php namespace MS\GestionBibliothequeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MS\GestionBibliothequeBundle\Entity\Reservation;

class ReservationRepository extends EntityRepository {
    
    public function countByEtatReservation(Reservation $reservation) {
        $qb = $this->createQueryBuilder('r')->select('COUNT(r)')->join('r.adherent', 'a')->join('r.oeuvre', 'o');
        $qb->andWhere('r.adherent = :adherent')->setParameter('adherent', $reservation->getAdherent());
        $qb->andWhere('r.suiteReservation = :suiteReservation')->setParameter('suiteReservation', $reservation->getSuiteReservation());
        $qb->andWhere('o.id = :o_id')->setParameter('o_id', $reservation->getOeuvre()->getId());
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function countByEtatReservationForAllAdherents(Reservation $reservation) {
        $qb = $this->createQueryBuilder('r')->select('COUNT(r)')->join('r.adherent', 'a')->join('r.oeuvre', 'o');
        $qb->andWhere('r.suiteReservation = :suiteReservation')->setParameter('suiteReservation', $reservation->getSuiteReservation());
        $qb->andWhere('o.id = :o_id')->setParameter('o_id', $reservation->getOeuvre()->getId());
        return $qb->getQuery()->getOneOrNullResult();
    }
}