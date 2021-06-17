<?php

namespace App\DataFixtures;

use App\Entity\StudyField;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudyFieldFixtures extends Fixture
{
    public const LOOPNUMBER = 10;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::LOOPNUMBER; $i++) {
            $studyField = new StudyField();
            $studyField->setStudyFieldName('Domaine : ' . $i);

            $manager->persist($studyField);
            $this->addReference('studyField_' . $i, $studyField);
        }

        $manager->flush();
    }
}
