<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;

abstract class BaseFixture extends  Fixture
{
    private $references;
    public function __construct()
    {
        $this->references=[];
    }
    protected function getReferences(string $name)
    {
        if(!array_key_exists($name,$this->references))
        {
            $refs=$this->referenceRepository->getReferences();
            $this->references[$name]=[];
            foreach ($refs as $ref=>$entity)
            {
                if(strpos($ref,$name.'_')===0)
                {
                    $this->references[$name][]=$this->getReference($ref);
                }
            }
        }
        return $this->references[$name];
    }
}