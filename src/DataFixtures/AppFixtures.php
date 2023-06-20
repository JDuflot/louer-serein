<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\User;
use App\Entity\Rental;
use App\Entity\Picture;
use App\Entity\Equipment;
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
        $faker = Factory::create('fr_FR');
        $rentalJsons = \file_get_contents($this->kernel->getProjectDir() . '/assets/js/Data/annonces.json');
        $rentalJsons = \json_decode($rentalJsons, true);
        foreach ($rentalJsons as $data) {
            $rental = new Rental();
            $rental
                ->setTitle($data['title'])
                ->setCover($data['cover'])
                ->setDescription($data['description'])
                ->setLocation($data['location'])
                ->setPrice($faker->numberBetween(55, 550))
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setSlug($faker->slug())
                ;

            // $picture = new Picture();
            // $picture
            //     ->setPicture($data['pictures']);

            // $equipment = new Equipment();
            // $equipment
            //     ->setName($data['name']);

            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setFirstname($faker->firstname())
                ->setLastname($faker->lastname())
                ->setPassword("password")
                ->setPicture("https://i.pravatar.cc/150?u=". $faker->randomNumber())
                ->setAddress($faker->address())
                ->setZip($faker->departmentNumber() . '000')
                ->setCity($faker->city())
                ->setRating($faker->numberBetween(1, 5))
                ;

            $manager->persist($user);
            $manager->persist($rental);

            $manager->flush();
        }
    }
}
