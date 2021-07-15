<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\LegalNotice;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LegalNoticeFixtures extends Fixture
{
    public const LOOPNUMBER = 3;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $legalNotice = new LegalNotice();
            $legalNotice->setTitle('Mention Légale ' . $i);
            $legalNotice->setText($faker->text(1000));

            $manager->persist($legalNotice);
        }
        $manager->flush();
    }
}
