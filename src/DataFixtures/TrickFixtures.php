<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Trick;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();
        $categories = array("grabs", "butter tricks", "Spins flips and corks", "Rails and boxes");
        $trickNames = array("bluntslide", "corked-spin", "indy", "nose-press", "ollie-nollie", "rodeo", "tail", "tamedog", "tripod", "weddle");
        $users = ['user1', 'user2', 'user3', 'user4', 'user5'];
        foreach ($trickNames as $trickName) {
            $trick = new Trick();
            $trick->setName($trickName);
            $trick->setSlug(str_replace('-', '', $trickName));
            $randcategorieKey = array_rand($categories);
            $trick->setCategory($categories[$randcategorieKey]);
            $trick->setDescription($faker->text(150));
            $trick->setCreatedAtValue($faker->dateTime('now', null));
            $trick->setUpdatedAtValue($faker->dateTime('now', null));
            $userRandKey = array_rand($users);
            $trick->setUser($this->getReference($users[$userRandKey]));

            $manager->persist($trick);

            $this->addReference($trickName, $trick);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
