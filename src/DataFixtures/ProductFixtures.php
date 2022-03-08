<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductFixtures extends Fixture
{
    public function __construct(
        private SluggerInterface $slugger
    ){}


    public function load(ObjectManager $manager): void
    {
        // use the factory to create a faker\generator instance
        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 10 ; $i++)
        {
            $product = new Product();

            $product->setName($faker->text(15));
            $product->setDescription($faker->text());
            $product->setSlug($this->slugger, $product->getName());
            $product->setPrice($faker->numberBetween(900, 150000));
            $product->setStock($faker->numberBetween(0, 10));

            // search category reference
            /** @var Category $category */
            $category = $this->getReference('cat-'.rand(1,7));

            $product->setCategory($category);

            $this->setReference('prod-'.$i, $product);
            $manager->persist($product);
        }

        $manager->flush();
    }

}
