<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Job;
use App\DataFixtures\CompanyFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($e = 1; $e <= CompanyFixtures::LOOPNUMBER; $e++) {
            $faker = Factory::create('FR,fr');
            $job = new Job();
            $job->setPost($faker->jobTitle());
            $job->setRegisteredAt($faker->dateTime());
            $job->setStartAt($faker->dateTime());
            $job->setEndAt($faker->dateTime());
            $job->setHoursAWeek(rand(25, 35));
            $job->setPostalCode($faker->numberBetween(30, 97));
            $job->setCity($faker->city());
            $job->setDescription('Veniam qui aliqua deserunt do nisi consectetur pariatur consectetur tempor eiusmod.');
            $job->setCompany($this->getReference('company_' . rand(1, CompanyFixtures::LOOPNUMBER)));

            $manager->persist($job);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
