<?php


namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
  /**
   * @var SluggerInterface
   */
  private $slugger;

  /**
   * @var UserPasswordEncoderInterface
   */
  private $passwordEncoder;

  public function __construct(SluggerInterface $slugger, UserPasswordEncoderInterface $passwordEncoder){
    $this->slugger = $slugger;
    $this->passwordEncoder = $passwordEncoder;
  }

  public function load(ObjectManager $manager){

    $faker = \Faker\Factory::create('fr_FR');

    // Créer les catégories
    $plainCategories = ['Smartphone', 'TV', 'PC', 'Hi-Fi'];
    $categories = [];
    foreach ($plainCategories as $plainCategory) {
      $category = new Category();
      $category->setName($plainCategory);
      $category->setSlug($this->slugger->slug($plainCategory)->lower());
      $manager->persist($category);
      $categories[] = $category;
    }

    $users = [];
    //Créer les utilisateurs
    for ($i = 1; $i <= 10; $i++) {
      $username = (1 === $i) ? 'lucas' : $faker->userName;
      $roles = (1 === $i) ? ['ROLE_ADMIN'] : ['ROLE_USER'];

      $user = new User();
      $user->setUsername($username);
      $user->setPassword(
        $this->passwordEncoder->encodePassword($user, 'test')
      );
      $user->setRoles($roles);
      $manager->persist($user);
      $users[] = $user;
    }

    //Créer les produits
    for ($i = 1; $i <= 20; ++$i) {
      $colors = [];
      $nb = random_int(1,3);
      for ($j = 0; $j <= $nb; ++$j){
        $color = $faker->safeColorName;
        $colors[] = $color;
      }
      $color = array_rand($colors);
      $product = new Product();
      $product->setName('Produit '.$i);
      $product->setSlug($this->slugger->slug($product->getName())->lower());
      $product->setDescription($faker->text);
      $product->setPrice(rand(10, 1000) * 100);
      $product->setCoeur((bool) $faker->boolean(50));
      $product->setColor($colors);
      $product->setDate($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = 'Europe/Paris'));
      $product->setPromotion(random_int(5,45));
      $product->setCategory($categories[rand(0,3)]);
      $manager->persist($product);
    }
    $manager->flush();
  }
}