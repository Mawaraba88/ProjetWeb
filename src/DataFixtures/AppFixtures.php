<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Documenttype;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        /*
         * Création de fausses données pour l'utilisateurs
         */
        $faker = Faker\Factory::create();
        $users = [];
        for ($i=0; $i<20; $i++)
        {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setAddress($faker->address);
            $user->setField($faker->domainName);
            $user->setPhone($faker->phoneNumber);
            $user->setInstitution($faker->text(50));
            $user->setResearchsubject($faker->text(50));
            $user->setStudylevel($faker->text(50));


            $manager->persist($user);
            $users[] = $user;

        }
        $categories = [];
        for ($i=0; $i<3; $i++){
            $category = new Category();
            $category->setName($faker->text(50));
            $manager->persist($category);
            $categories[] = $category;

        }

        for ($i=0; $i<100; $i++){
            $documenttype = new Documenttype();
            $documenttype->setTitle($faker->text(50));
            $documenttype->setResume($faker->text(250));
            $documenttype->setPicture($faker->imageUrl());
            $documenttype->setCreatedAt(new \DateTime());
            $documenttype->setCategory($categories[$faker->numberBetween(0,2)]);
            $documenttype->addAuthor($users[$faker->numberBetween(0,19)]);
            $manager->persist($documenttype);

        }

        $manager->flush();
    }
}
