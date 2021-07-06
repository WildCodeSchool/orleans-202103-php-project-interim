<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Company;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompanyFixtures extends Fixture
{
    public const LOOPNUMBER = 50;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $company = new Company();
            $company->setCompanyName($faker->company());
            $company->setSocialReason('HYPERDRIVE EURL : ' . $i);
            $company->setSiret($faker->numberBetween(10000000000000, 99999999999999));

            $manager->persist($company);
            $this->addReference('company_' . $i, $company);
        }

        $manager->flush();
    }
}
