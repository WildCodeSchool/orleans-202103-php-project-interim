<?php

namespace App\DataFixtures;

use DateTime;
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
            $job = new Job();
            $job->setPost('Nom de Poste : ' . $e);
            $job->setRegistereAt(new DateTime());
            $job->setStartAt(new DateTime());
            $job->setEndAt(new DateTime());
            $job->setHoursAWeek(rand(25, 35));
            $job->setPostalCode(rand(45, 95));
            $job->setCity('Ville');
            $job->setDescription('Veniam qui aliqua deserunt do nisi consectetur pariatur consectetur tempor eiusmod.');
            for ($c = 1; $c <= rand(1, CompanyFixtures::LOOPNUMBER); $c++) {
                $job->setCompany($this->getReference('company_' . $c));
            }

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
