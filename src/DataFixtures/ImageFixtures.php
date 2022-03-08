<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 50 ; $i++)
        {
            $image = new Image();

            $image->setName($faker->image(null, 340, 480));
            /** @var Product $product */
            $product = $this->getReference('prod-'.rand(1,10));
            $image->setProduct($product);
            $manager->persist($image);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class
        ];
    }
}
