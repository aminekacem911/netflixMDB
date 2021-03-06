<?php

namespace App\DataFixtures;
use App\Entity\Utilisateur;
use App\Entity\Setting;
use App\Entity\Faq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
  
 
    public function load(ObjectManager $manager)
    {
        $user = new Utilisateur();
        $user->setEmail('admin@admin.com');
        $role = ['ROLE_ADMIN'];
        $user->setRoles($role); 
        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();

        $setting = new Setting();
        $setting->setTitle('NetflixMDB');
        $setting->setLogo('logo.png');
        $setting->setMobile('+21693387306');
        $manager->persist($setting);
        $manager->flush();


        $faq = new Faq();
        $faq->setQuestion('whats this website ?');
        $faq->setAnswer('Netflix is a streaming service that offers a wide variety of award-winning TV shows, movies, anime, documentaries, and more on thousands of internet-connected devices.');
        $manager->persist($faq);
        $manager->flush();
    }
}
