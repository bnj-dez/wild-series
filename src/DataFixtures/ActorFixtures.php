<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Danai Gurira',
        'Lauren Cohan'
    ];

    public function getDependencies(){
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $i =0;
        while ($i < 100) {
            $faker  =  Faker\Factory::create('fr_FR');
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->getPrograms($this->getReference('program_' . rand(0, 5)));

            $slug = $slugify->generate($actor->getName());
            $actor->setSlug($slug);

            $manager->persist($actor);

            $i++;
        }
        $manager->flush();
    }
}