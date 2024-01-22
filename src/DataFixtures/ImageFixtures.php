<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ImageFixtures extends Fixture implements DependentFixtureInterface
{

    public const IMAGE_REFERENCE = 'image';
    public function load(ObjectManager $manager): void
    {

        $trickNames = array("bluntslide", "corked-spin", "indy", "nose-press", "ollie-nollie", "rodeo", "tail", "tamedog", "tripod", "weddle");

        foreach($trickNames as $trickName){

            for($i = 1; $i < 4; $i++)
            {
                $image = new Image();
                $image->setTrick($this->getReference($trickName));
                $image->setFileName($trickName.'_'.$i.'.'.'jpg');
                $manager->persist($image);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TrickFixtures::class,
        );
    }
}