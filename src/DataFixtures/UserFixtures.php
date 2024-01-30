<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{

    private $faker;
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = \Faker\Factory::create();
    }
    public const USER_REFERENCE = 'user';
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();
        for ($i = 1; $i < 6; ++$i) {
            $user = new User();
            $password = $this->hasher->hashPassword($user, $this->faker->word);
            $user->setUsername($faker->unique()->text(15));
            $user->setEmail($faker->email);
            $user->setPassword($password);
            $user->setAvatarFilename('user' . $i . '.jpg');
            $user->setCreatedAtValue($this->faker->dateTime('now', null));

            $manager->persist($user);

            $this->addReference('user' . $i, $user);
        }

        $manager->flush();
    }
}
