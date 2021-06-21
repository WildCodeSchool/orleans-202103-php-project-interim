<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();

        // Création d’un utilisateur de type “student”
        $student = new User();
        $student->setFirstname('Etudiant');
        $student->setLastname('n°1');
        $student->setPhone('0123456789');
        $student->setEmail('student@monsite.com');
        $student->setRoles(['ROLE_STUDENT']);
        $student->setPassword($this->passwordEncoder->encodePassword(
            $student,
            'studentpassword'
        ));

        $manager->persist($student);

        // Création d’un utilisateur de type “company”
        $company = new User();
        $company->setFirstname('Monsieur');
        $company->setLastname('Ramu');
        $company->setPhone('0836656565');
        $company->setEmail('company@monsite.com');
        $company->setCompany($this->getReference('company_1'));
        $company->setRoles(['ROLE_COMPANY']);
        $company->setPassword($this->passwordEncoder->encodePassword(
            $company,
            'companypassword'
        ));

        $manager->persist($company);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setFirstname('Oui');
        $admin->setLastname('Oui');
        $admin->setPhone('01100110');
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CompanyFixtures::class,
        ];
    }
}
