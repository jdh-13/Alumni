<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Year;
class YearFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($cpt=2010;$cpt<2030 ;$cpt++){

        $year= new Year();

        $year->setTitle($cpt);
        $manager->persist($year);
            $this->addReference('Year_'.$cpt,$year);
    }
        $manager->flush();
    }
}
