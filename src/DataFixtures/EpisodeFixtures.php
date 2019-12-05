<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $i =0;
        while ($i < 1000) {
            $faker  =  Faker\Factory::create('fr_FR');
            $episode = new Episode();
            $episode->setNumber($faker->numberBetween(1, 20));
            $episode->setSynopsis($faker->text(250));
            $episode->setTitle($faker->text(25));

            $episode->setSeasonId($this->getReference('season_' . rand(0, 100)));

            $manager->persist($episode);

            $i++;
        }
        $manager->flush();
    }
}