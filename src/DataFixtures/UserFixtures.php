<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
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
        $student->setEmail('student@monsite.com');
        $student->setRoles(['ROLE_STUDENT']);
        $student->setPassword($this->passwordEncoder->encodePassword(
            $student,
            'studentpassword'
        ));

        $manager->persist($student);

        // Création d’un utilisateur de type “company”
        $company = new User();
        $company->setEmail('company@monsite.com');
        $company->setRoles(['ROLE_COMPANY']);
        $company->setPassword($this->passwordEncoder->encodePassword(
            $company,
            'companypassword'
        ));

        $manager->persist($company);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
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
}
