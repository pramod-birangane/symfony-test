<?php

namespace App\Repository;

use App\Entity\Leagues;
use App\Entity\Teams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LeaguesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Leagues::class);
    }

    public function getLeagueById($leagueId)
    {
      return $this->find($leagueId);
    }

    public function deleteLeague($league)
    {
      $em = $this->getEntityManager();
      $em->getRepository(Teams::class)->deleteTeamsInLeague($league->getId());
      $em->remove($league);
      $em->flush();
    }
}
