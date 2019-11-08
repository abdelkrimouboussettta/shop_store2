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

    for ($k=1;$k<6;$k++)
    {
        $categorie =new Categorie();
            $categorie->setTitre($faker->sentence())
                                  ->setresume($faker->paragraph());

                $manager->persist($categorie);
        for ($i=1;$i<=31;$i++)
        {           
            $article = new Article();
            $article ->setTitle($faker->sentence())
                     ->setContent("content")
                     ->setimage($faker->ImageURl())
                     ->setCreatedAt(new \DateTime())
                     ->setResume($faker->paragraph($nbSentences=5,$variableNbSentences=true))
                     ->setCategorie($categorie);

             $manager->persist($article);

            for ($j=1;$j<11;$j++)
            {
            $commentaires=new Commentaires();
            $commentaires->setAuteur($faker->name())
                ->setCommentaire($faker->paragraph($nbSentences=5,$variableNbSentences=true))
                         ->setCreatedAt(new \DateTime())
                         ->setArticle($article);

            $manager->persist($commentaires);

            }
        }
    }
    $manager->flush();
    }
}
