<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Rental;
use App\Entity\Picture;
use App\Entity\Equipment;
use App\Entity\RentalEquipment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\KernelInterface;

class AppFixtures extends Fixture
{
    public function __construct(private KernelInterface $kernel)
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
        foreach ($rentalJsons as $data) {
            $rental = new Rental();
            $rental
                ->setTitle($data['title'])
                ->setCover($data['cover'])
                ->setDescription($data['description'])
                ->setLocation($data['location'])
                ->setPrice($faker->numberBetween(55, 550))
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setSlug($faker->slug());

            $manager->persist($rental);
            
            $rentalEquipment = new RentalEquipment;
            $rentalEquipment->setRental($rental);
            foreach ($data['equipments'] as $equip){
                $rentalEquipment->addEquipment($equipments[$equip]);
            }
            $manager->persist($rentalEquipment);

        }

        for ($k = 0; $k < 20; $k++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setFirstname($faker->firstname())
                ->setLastname($faker->lastname())
                ->setPassword("password")
                ->setPicture("https://i.pravatar.cc/150?u=" . $faker->randomNumber())
                ->setAddress($faker->address())
                ->setZip($faker->departmentNumber() . '000')
                ->setCity($faker->city())
                ->setRating($faker->numberBetween(1, 5));

            $manager->persist($user);
        }
        
        for ($l = 0; $l < 1; $l++) {
            $admin = new User();
            $admin
                ->setEmail($faker->email())
                ->setFirstname('Admin')
                ->setLastname('Location')
                ->setPassword('password')
                ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
                ->setPicture("https://i.pravatar.cc/150?u=" . $faker->randomNumber())
                ->setAddress('2 rue de la liberté')
                ->setZip(13000)
                ->setCity("Salon de Provence")
                ->setRating(4);
            $user = $admin;
            $manager->persist($admin);
        }
        $manager->flush();
    }
}
