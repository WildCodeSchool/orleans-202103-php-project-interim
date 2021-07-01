<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public const LOOPNUMBER = 10;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $student = new Student();
            $student->setLevel('Bac + ' . $faker->numberBetween(1, 8));
            $student->setBirthdate($faker->dateTimeBetween('1990-01-01 00:00:00', 'now'));

            $manager->persist($student);
            $this->addReference('student_' . $i, $student);
        }

        $manager->flush();
    }
}
