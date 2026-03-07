<?php

namespace App\Service\User\Persistent;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserCreator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(string $name, int $age): User
    {
        $user = new User();
        $user->setName($name);
        $user->setAge($age);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
