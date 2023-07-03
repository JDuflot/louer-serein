<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Chat;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Rental;
use App\Entity\Picture;
use App\Entity\Equipment;
// use App\Entity\RentalEquipment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private KernelInterface $kernel, private UserPasswordHasherInterface $hasher)
    {
    }


    public function load(ObjectManager $manager): void
    {
        $rentalJsons = \file_get_contents($this->kernel->getProjectDir() . '/assets/js/Data/annonces.json');
        $rentalJsons = \json_decode($rentalJsons, true);

        $equimentData = array_map(function ($rental) {
            return $rental['equipments'];
        }, $rentalJsons);

        $equimentData = array_unique(array_merge(...$equimentData));

        $equipments = [];
        foreach ($equimentData as $data) {
            $equipment = new Equipment();
            $equipment
                ->setName($data);
            $manager->persist($equipment);
            $equipments[$data] = $equipment;
        }

        $faker = Factory::create('fr_FR');
        $users = [];
        for ($k = 0; $k < 20; $k++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setFirstname($faker->firstname())
                ->setLastname($faker->lastname())
                ->setPassword($this->hasher->hashPassword($user, 'password'))
                ->setPicture("https://i.pravatar.cc/150?u=" . $faker->randomNumber())
                ->setAddress($faker->streetAddress())
                ->setZip($faker->departmentNumber() . '000')
                ->setCity($faker->city())
                ->setRating($faker->numberBetween(1, 5));
            $users[] = $user;
            $manager->persist($user);
        }
        $rentals = [];
        foreach ($rentalJsons as $data) {
            $rental = new Rental();
            $rental
                ->setTitle($data['title'])
                ->setCover($data['cover'])
                ->setDescription($data['description'])
                ->setLocation($data['location'])
                ->setPrice($faker->numberBetween(55, 550))
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setOwner($faker->randomElement($users));

            $manager->persist($rental);
            $rentals[] = $rental;

            // $rentalEquipment = new RentalEquipment;
            // $rentalEquipment->setRental($rental);
            // $manager->persist($rentalEquipment);

            foreach ($data['equipments'] as $equip) {
                $rental->addEquipment($equipments[$equip]);
            }
        }


        for ($l = 0; $l < 1; $l++) {
            $admin = new User();
            $admin
                ->setEmail($faker->email())
                ->setFirstname('Admin')
                ->setLastname('Location')
                ->setPassword($this->hasher->hashPassword($admin, 'password'))
                ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
                ->setPicture("https://i.pravatar.cc/150?u=" . $faker->randomNumber())
                ->setAddress('2 rue de la liberté')
                ->setZip(13000)
                ->setCity("Salon de Provence")
                ->setRating(4);
            $user = $admin;
            $manager->persist($admin);
        }

        foreach ($rentals as $rental) {
            for ($i = 0; $i < mt_rand(0, 3); $i++) {
                $chat = new Chat();
                $chat
                    ->setRental($rental)
                    ->setSender($users[mt_rand(0, count($users) - 1)])
                    ->setRecipient($users[mt_rand(0, count($users) - 1)])
                    ->setMessage($faker->realText());
                $rentals[] = $chat;
                $manager->persist($chat);
                // $rental->addChat($chat);
            }
        }

        $manager->flush();
    }
}
