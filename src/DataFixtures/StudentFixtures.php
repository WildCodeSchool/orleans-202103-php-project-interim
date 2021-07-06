<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    public const LOOPNUMBER = 50;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $student = new Student();
            $student->setLevel('Bac + ' . $faker->numberBetween(1, 8));
            $student->setBirthdate($faker->dateTimeBetween('1990-01-01 00:00:00', 'now'));
            $student->setStudyField(
                $this->getReference('studyField_' . rand(0, count(StudyFieldFixtures::STUDYFIELD) - 1))
            );

            $manager->persist($student);
            $this->addReference('student_' . $i, $student);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            StudyFieldFixtures::class,
        ];
    }
}
