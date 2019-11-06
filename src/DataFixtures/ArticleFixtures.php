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
   
    for ($k=1;$k<10;$k++)
    {
        $categorie =new Categorie();
            $categorie->setTitre("titre")
                      ->setresume("resume");

                $manager->persist($categorie);
        for ($i=1;$i<=10;$i++)
        {           
            $article = new Article();
            $article ->setTitle("titre")
                     ->setContent("content")
                     ->setimage("image")
                     ->setCreatedAt(new \DateTime())
                     ->setResume("resume")
                     ->setCategorie($categorie);

             $manager->persist($article);

            for ($j=1;$j<5;$j++)
            {
            $commentaires=new Commentaires();
            $commentaires->setAuteur("auteur")
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
