<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 8; $i++) { 

            $nameArray = ['Galaxy s20', 'Iphone 11', 'Iphone 10', 'Galaxy A51', 'Iphone 9', 'Iphone 12', 'Galaxy s10','Galaxy a10'];
            $imgArray = ["f1122af9-galaxy-a41__450_400-5ff6d4658728b.jpeg", "a51.jpg","iphone11.jpg","p30.jpg","s20.jpg"];    

            $category1 = $this->em->getRepository(Category::class)->find(2);
            $category2 = $this->em->getRepository(Category::class)->find(3);
            
            $randNameIndex = random_int(0, count($nameArray) - 1);
            $name = $nameArray[$randNameIndex];

            $randImgIndex = random_int(0, count($imgArray) - 1);
            $img = $imgArray[$randImgIndex];

            $price = random_int(10000, 20000);
            
            unset($nameArray[$randNameIndex]);

            $product = new Product();

            $category = substr($name, 0, 1) === 'I' ? $category1 : $category2;

            $product->setName($name)
                    ->setPrice($price)
                    ->setSlug($name)
                    ->setImg($img)
                    ->setCategory($category);
    
            $manager->persist($product);
        }

        $manager->flush();
    }
}
