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

//        BranchFactory::createMany(10, ['loans' => LoanFactory::new()->many(10)]);
        BranchFactory::createMany(10);

        LoanFactory::createMany(100, function(){ return ['branch' => BranchFactory::random()]; });

        $manager->flush();
    }
}
