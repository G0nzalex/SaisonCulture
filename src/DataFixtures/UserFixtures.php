<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTimeImmutable;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $date = new DateTimeImmutable();
        $user1 =(new User())
        ->setEmail("alexandre@gmail.com")
        ->setRoles(array('ROLE_ADMIN'))
        ->setCreatedAt($date);
        $password = $this->hasher->hashPassword($user1, "bonjour");
        $user1->setPassword($password);
        $manager->persist($user1);
        $manager->flush();


    }
}
