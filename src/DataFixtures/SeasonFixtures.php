<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $i =0;
        while ($i <= 100) {
            $faker  =  Faker\Factory::create('fr_FR');
            $season = new Season();
            $season->setNumber($faker->numberBetween(1, 100));
            $season->setYear($faker->year);
            $season->setDescription($faker->Text(250));
            $season->setProgramId($this->getReference('program_' . rand(0, 5)));

            $manager->persist($season);

            $this->addReference('season_' . $i, $season);
            $i++;
        }
        $manager->flush();
    }
}