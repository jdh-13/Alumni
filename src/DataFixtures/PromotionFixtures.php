<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{
    function load (ObjectManager $manager)
    {
       $degrees = $this->getReferences('Degree');
       $years = $this->getReferences('Year');
       $i=0;
       foreach ($degrees as $degree)
        {
            foreach($years as $year)
            {
               $promotion= new Promotion();
               $promotion->setDegree($degree);
               $promotion->setYear($year);
               $promotion->setStartDate(\DateTime::createFromFormat('Y-m-d', "2000-09-09"));
               $promotion->setEndDate(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));
               $promotion->setNotes('voici un exemple de note');
               $manager->persist($promotion);
               $this->addReference('Promotion_'.$i,$promotion);
               $i++;
            }
        }
    $manager->flush();
    }
    public function getDependencies()
    {
        return [
            DegreeFixtures::class,
            YearFixtures::class
        ];
    }
}
