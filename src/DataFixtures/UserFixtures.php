<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@ecommerce.fr');
        $admin->setLastname('C');
        $admin->setFirstname('alain');
        $admin->setAddress('17 rue dupont');
        $admin->setZipcode('75003');
        $admin->setCity('Paris');

        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 5 ; $i++)
        {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipcode(str_replace(' ', '', $faker->postcode));
            $user->setCity($faker->city);

            $user->setPassword($this->hasher->hashPassword($user, 'secret'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
