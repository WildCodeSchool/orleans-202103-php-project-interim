<?php

namespace App\DataFixtures;

use App\Entity\StudyField;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudyFieldFixtures extends Fixture
{
    public const STUDYFIELD = ['Général' , 'Droit' , 'Economie' ,
    'Gestion' , 'STAPS' , 'Biologie' , 'Chimie' , 'Informatique' , 'Mathématiques' ,
    'Physique' , 'Histoire' , 'Langues' , 'Lettres' , 'Géographie et Aménagement' ,
    'Polytech' , 'Médecine' ,
    'MEEF'];
    public function load(ObjectManager $manager)
    {
        foreach (self ::STUDYFIELD as $key => $field) {
            $studyField = new StudyField();
            $studyField->setStudyFieldName($field);

            $manager->persist($studyField);
            $this->addReference('studyField_' . $key, $studyField);
        }

        $manager->flush();
    }
}
