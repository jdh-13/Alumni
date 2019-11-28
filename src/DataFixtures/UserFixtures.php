<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture implements DependentFixtureInterface
{
    private $SvgAvatarFactory;
    /**
     * @var FileSystemHelper
     */
    private $FileSystemHelper;
    private $uploadPath;
    private $passwordEncoder;

    public function __construct(SvgAvatarFactory $SvgAvatarFactory,FileSystemHelper $FileSystemHelper, $uploadPath,
    UserPasswordEncoderInterface $passwordEncoder )
    {
        parent::__construct();
        $this->passwordEncoder = $passwordEncoder;
        $this->SvgAvatarFactory=$SvgAvatarFactory;
        $this->FileSystemHelper=$FileSystemHelper;
        $this->uploadPath = $uploadPath;
    }

    public function load(ObjectManager $manager)
    {
        $promotions = $this->getReferences('Promotion');
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 200; $i++) {
            $user = new User();
            $user->setFirstname($faker->name);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->freeEmail);
            $passwordHashed = $this->passwordEncoder->encodePassword($user, 'teste');
            $user->setPassword($passwordHashed);
            $user->setCity($faker->city);
            $user->setBirthdate($faker->date($format = 'Y-m-d', $max = 'now'));

            $promo = $promotions[rand(0, count($promotions) - 1)];
            $user->addPromotion($promo);

            $svg = $this->SvgAvatarFactory->getAvatar(2, 5);

            // Création d'un nom de fichier unique et aléatoire
            $filename = sha1(uniqid(rand(), true)) . '.svg';

            // Crée les dossiers s'ils n'existent pas, et écrit dedans le contenu
            $this->FileSystemHelper->write($this->uploadPath . '/' . $this->SvgAvatarFactory::AVATAR_DIR . '/' . $filename, $svg);
            $user->setAvatar($filename);

            $manager->persist($user);
        }


        // cree admin
        $admin = new User();
        $admin->setFirstname('jerome');
        $admin->setLastname('De HARO');
        $admin->setEmail('jeje@hotmail.fr');

        $passwordHashed = $this->passwordEncoder->encodePassword($admin, 'admin');
        $admin->setPassword($passwordHashed);

        $admin->setCity('marignane');
        $admin->setBirthdate('1993-09-24');
        $admin->setAvatar($this->createAvatar());
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->flush();
    }
        

    public function getDependencies()
    {
        return [
            PromotionFixtures::class
                ];
    }
    function createAvatar()
    {
        $svg = $this->SvgAvatarFactory->getAvatar(2, 5);

            // Création d'un nom de fichier unique et aléatoire
        $filename = sha1(uniqid(rand(), true)) . '.svg';

            // Crée les dossiers s'ils n'existent pas, et écrit dedans le contenu
        $this->FileSystemHelper->write($this->uploadPath . '/' . $this->SvgAvatarFactory::AVATAR_DIR . '/' . $filename, $svg);
       return $filename;
    }
}
