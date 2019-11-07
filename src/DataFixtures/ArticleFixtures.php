<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\CATEGORIE;

use App\Entity\Commentaires;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create();

    for ($k=1;$k<10;$k++)
    {
        $categorie =new Categorie();
            $categorie->setTitre($faker->sentence())
                      ->setresume("resume");

                $manager->persist($categorie);
        for ($i=1;$i<=10;$i++)
        {           
            $article = new Article();
            $article ->setTitle($faker->sentence())
                     ->setContent("content")
                     ->setimage($faker->ImageURl())
                     ->setCreatedAt(new \DateTime())
                     ->setResume("resume")
                     ->setCategorie($categorie);

             $manager->persist($article);

            for ($j=1;$j<5;$j++)
            {
            $commentaires=new Commentaires();
            $commentaires->setAuteur($faker->name())
                         ->setCommentaire("commentaire")
                         ->setCreatedAt(new \DateTime())
                         ->setArticle($article);

            $manager->persist($commentaires);

            }
        }
    }
    $manager->flush();
    }
}
