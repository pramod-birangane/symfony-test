<?php

namespace App\Repository;

use App\Entity\Teams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TeamsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Teams::class);
    }

    public function getTeamsByLeagueId($leagueId)
    {
      return $this->createQueryBuilder('t')
        ->innerJoin('t.League', 'l')
        ->addSelect('l')
        ->andWhere('t.League = :id')
        ->setParameter('id', $leagueId)
        ->getQuery()
        ->getResult();
    }

    public function deleteTeamsInLeague($leagueId)
    {
      $em = $this->getEntityManager();
      $q = $em->createQuery('delete from App\Entity\Teams as t where t.League = '.$leagueId);
      $numDeleted = $q->execute();
    }
}
