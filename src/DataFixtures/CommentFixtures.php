<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CommentFixtures extends Fixture implements DependentFixtureInterface
{

    public const COMMENT_REFERENCE = 'comment';
    public function load(ObjectManager $manager): void
    {

        $trickNames = array("bluntslide", "corked-spin", "indy", "nose-press", "ollie-nollie", "rodeo", "tail", "tamedog", "tripod", "weddle");
        $users = ['user1', 'user2', 'user3', 'user4', 'user5'];
        foreach ($trickNames as $trickName) {

            for ($i = 1; $i < 6; $i++) {
                $faker = Factory::create();
                $comment = new Comment();
                $comment->setComment($faker->text(50));
                $userRandKey = array_rand($users);
                $comment->setUser($this->getReference($users[$userRandKey]));
                $comment->setTrick($this->getReference($trickName));
                $comment->setCreatedAtValue($faker->dateTime('now', null));
                $comment->setUpdatedAtValue($faker->dateTime('now', null));
                $manager->persist($comment);
            }

            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TrickFixtures::class,
        );
    }
}
