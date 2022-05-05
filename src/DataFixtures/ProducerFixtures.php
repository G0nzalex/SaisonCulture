<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTimeImmutable;


class ProducerFixtures extends Fixture
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
        ->setName("Nicaise Alexandre")
        ->setEmail("alexandre.nicaise.2000@gmail.com")
        ->setToken("7")
        ->setCompany("Les produits de chez nous")
        ->setAddress1("rue Deschamps")
        ->setCity("Le Havre")
        ->setZipcode(12345)
        ->setPhone(330698216523)
        ->setCreatedAt($date)
        ->setRoles(array('ROLE_PRODUCER'));
        $password = $this->hasher->hashPassword($user1, "bonjour");
        $user1->setPassword($password);
        $manager->persist($user1);
        $manager->flush();


    }
}
