<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function createUser($username, $password, $encoder)
    {
      $em = $this->getEntityManager();
      $user = new User($username);
      $user->setPassword($encoder->encodePassword($user, $password));
      $em->persist($user);
      $em->flush();
      return $user;
    }
}
