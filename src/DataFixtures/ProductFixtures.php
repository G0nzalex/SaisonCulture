<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = (new Products())
        ->setName("pomme")
        ->setBio(true)
        ->setStock(10)
        ->setPrice(200)
        ->setDescription("Fruit issu d'un pommier")
        ->setImg("http://SaisonCulture/assets/img/uneImage.jpg")
        ->setActive(true)
        ->setCreatedAt(new \DateTimeImmutable())
        ->setModifiedAt(new \DateTimeImmutable());
        $manager->persist($product);

        $manager->flush();
    }
}
