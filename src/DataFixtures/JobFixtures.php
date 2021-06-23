<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Job;
use App\DataFixtures\CompanyFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\StudyFieldFixtures;
use App\Entity\StudyField;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($e = 1; $e <= CompanyFixtures::LOOPNUMBER; $e++) {
            $faker = Factory::create('fr_FR');
            $job = new Job();
            $job->setPost($faker->jobTitle());
            $job->setRegisteredAt($faker->dateTimeBetween('2021-01-01 00:00:00', 'now'));
            $job->setStartAt($faker->dateTimeBetween('2021-01-01 00:00:00', 'now'));
            $job->setEndAt($faker->dateTimeBetween('2021-01-01 00:00:00', 'now'));
            $job->setHoursAWeek(rand(25, 35));
            $job->setPostalCode($faker->numberBetween(30, 97));
            $job->setCity($faker->city());
            $job->setDescription($faker->paragraph(3, true));
            $job->setCompany($this->getReference('company_' . rand(1, CompanyFixtures::LOOPNUMBER)));
            for ($i = 1; $i < count(StudyFieldFixtures::STUDYFIELD); $i++) {
                $job->setStudyField($this->getReference('studyField_' . $i));
            }

            $manager->persist($job);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
            StudyFieldFixtures::class,
        ];
    }
}
