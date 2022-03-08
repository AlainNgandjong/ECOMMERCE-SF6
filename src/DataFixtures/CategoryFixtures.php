<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{

    private int $counter = 0;

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {

        $parent = $this->createCategory(name: 'Computer science', parent: null, manager: $manager);

        $this->createCategory(name: 'Computer', parent: $parent, manager: $manager);
        $this->createCategory(name: 'Screen', parent: $parent, manager: $manager);
        $this->createCategory(name: 'Mouse', parent: $parent, manager: $manager);

        $parent = $this->createCategory(name: 'Mode', parent: null, manager: $manager);

        $this->createCategory(name: 'Man', parent: $parent, manager: $manager);
        $this->createCategory(name: 'Woman', parent: $parent, manager: $manager);
        $this->createCategory(name: 'Child', parent: $parent, manager: $manager);
        $manager->flush();
    }

    public function createCategory(string $name, ?Category $parent, ObjectManager $manager): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger, $category->getName());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
