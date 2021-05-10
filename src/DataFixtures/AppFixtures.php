<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\BranchFactory;
use App\Factory\LoanFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        BranchFactory::createMany(1000);

        LoanFactory::createMany(10000, function(){ return ['branch' => BranchFactory::random()]; });

        $manager->flush();
    }
}
