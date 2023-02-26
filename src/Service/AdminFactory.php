<?php

namespace App\Service;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFactory
{
    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function createFromEmailAndRawPassword(string $email, string $rawPassword): Admin
    {
        $admin = new Admin();
        $admin->setEmail($email);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, $rawPassword));

        $this->entityManager->persist($admin);
        $this->entityManager->flush();

        return $admin;
    }
}
