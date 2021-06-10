<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public const LOOPNUMBER = 10;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self ::LOOPNUMBER; $i++) {
            $company = new Company();
            $company->setCompanyName('Nom de l\'entreprise : ' . $i);
            $company->setSocialReason('HYPERDRIVE EURL : ' . $i);
            $company->setSiret(rand(10000, 40000));

            $manager->persist($company);
            $this->addReference('company_' . $i, $company);
        }

        $manager->flush();
    }
}
