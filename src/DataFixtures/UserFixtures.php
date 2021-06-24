<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\DataFixtures\CompanyFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERS = 20;
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
        $student->setLastname('Chaprot');
        $student->setPhone('0123456789');
        $student->setEmail('student@monsite.com');
        $student->setStudent($this->getReference('student_1'));
        $student->setRoles(['ROLE_STUDENT']);
        $student->setPassword($this->passwordEncoder->encodePassword(
            $student,
            'studentpassword'
        ));

        $manager->persist($student);

        // Création d’une liste  d'utilisateurs de type “student”
        for ($i = 2; $i < StudentFixtures::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $student = new User();
            $student->setFirstname($faker->firstName());
            $student->setLastname($faker->lastName());
            $student->setPhone($faker->e164PhoneNumber());
            $student->setEmail($faker->email());
            $student->setStudent($this->getReference('student_' . $i));
            $student->setRoles(['ROLE_STUDENT']);
            $student->setPassword($this->passwordEncoder->encodePassword(
                $student,
                $faker->password()
            ));
            $manager->persist($student);
        }

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

        // Création d’une liste d'utilisateurs de type “company”
        for ($i = 2; $i < CompanyFixtures::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $company = new User();
            $company->setFirstname($faker->firstName());
            $company->setLastname($faker->lastName());
            $company->setPhone($faker->e164PhoneNumber());
            $company->setEmail($faker->email());
            $company->setCompany($this->getReference('company_' . $i));
            $company->setRoles(['ROLE_COMPANY']);
            $company->setPassword($this->passwordEncoder->encodePassword(
                $company,
                $faker->password()
            ));

            $manager->persist($company);
        }

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setFirstname('Oui');
        $admin->setLastname('Oui');
        $admin->setPhone('01100110');
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('adminfirstname');
        $admin->setLastname('adminlastname');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CompanyFixtures::class,
          StudentFixtures::class,
        ];
    }
}
