<?php


namespace App\DataFixtures;


use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
  public function __construct(SluggerInterface $slugger){
    $this->slugger = $slugger;
  }

  public function load(ObjectManager $manager){

    $faker = \Faker\Factory::create('fr_FR');

    $colors=['bleu','rouge','vert'];
    //Créer les produits
    for ($i = 1; $i <= 20; ++$i) {
      $color = array_rand($colors);
      $product = new Product();
      $product->setName('Produit '.$i);
      $product->setSlug($this->slugger->slug($product->getName())->lower());
      $product->setDescription($faker->text);
      $product->setPrice(rand(10, 1000) * 100);
      $product->setCoeur((bool) $faker->boolean(50));
      $product->setColor($colors);
      $product->setDate($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
      $manager->persist($product);
    }
    $manager->flush();
  }
}