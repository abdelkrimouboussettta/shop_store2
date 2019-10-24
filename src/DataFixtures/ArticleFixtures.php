<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
   
    
for ($i=1;$i<=10;$i++)
    {
        $article = new Article();
        $article ->setTitle("titre")
                ->setContent("content")
                ->setimage("image")
                ->setCreatedAt(new \DateTime())
                ->setResume("resume");

        $manager->persist($article);
    }
    $manager->flush();
}
}
