<?php
namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $degrees=['dev-web','web design','electricien','secretaire medical','java j2ee'];
        foreach ($degrees as $i => $value)
        {
            $degree= new Degree();
            $this->addReference('Degree_'.$i,$degree);
            $degree->setName($value);
            $manager->persist($degree);
        }
        $manager->flush();
    }
}
