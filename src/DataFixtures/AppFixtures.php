<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /** hash du mot de passe
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($j = 0;$j < 10; $j++) {
            $user = new User();

            $hash = $this->encoder->hashPassword($user, 'onsenfou');
            $user->setName($faker->lastName)
                ->setSurname($faker->firstName)
                ->setEmail($faker->email)
                ->setPassword($hash);

            $manager->persist($user);

            for($i=0;$i < mt_rand(1, 6);$i++) {
                $customer = new Customer();
                $customer->setName($faker->lastName)
                    ->setSurname($faker->firstName)
                    ->setEmail($faker->email)
                    ->setPhone($faker->e164PhoneNumber)
                    ->setRole($faker->jobTitle)
                    ->setUser($user);

                $manager->persist($customer);

                for($k=0;$k < mt_rand(3,10);$k++) {
                    $invoice = new Invoice();
                    $invoice->setMontant($faker->randomFloat(2, 49, 5000))
                        ->setDateEnvoie($faker->dateTimeBetween('-6 months'))
                        ->setStatus($faker->randomElement(['SENT', 'PAID', 'DELETE']))
                        ->setEnumInvoice($faker->dateTime)
                        ->setCustomer($customer);

                    $manager->persist($invoice);
                }
            }
        }

        $manager->flush();
    }
}
