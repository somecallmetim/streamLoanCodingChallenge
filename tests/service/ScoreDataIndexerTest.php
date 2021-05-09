<?php

namespace App\Tests\service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ScoreDataIndexerTest extends KernelTestCase
{

    private $scoreDataIndexer;


    protected function setUp(): void
    {
        self::bootKernel();
        $container = self::$kernel->getContainer()->get('test.service_container');
        $this->scoreDataIndexer = $container->get('App\service\ScoreDataIndexer');
    }

    public function testGetCountOfUsersWithinScoreRange(): void
    {
        $this->assertSame(9980, $this->scoreDataIndexer->getCountOfUsersWithinScoreRange(-50, 50));
        $this->assertSame(3040, $this->scoreDataIndexer->getCountOfUsersWithinScoreRange(20, 50));
        $this->assertSame(7620, $this->scoreDataIndexer->getCountOfUsersWithinScoreRange(0, 80));
    }

    public function testGetCountOfUsersByCondition(){
        $this->assertSame(40, $this->scoreDataIndexer->getCountOfUsersByCondition('France', 'F', true, false));
        $this->assertSame(20, $this->scoreDataIndexer->getCountOfUsersByCondition('France', 'F', false, false));
        $this->assertSame(20, $this->scoreDataIndexer->getCountOfUsersByCondition('Tonga', 'F', false, true));
        $this->assertSame(20, $this->scoreDataIndexer->getCountOfUsersByCondition('France', 'F', true, true));
        $this->assertSame(20, $this->scoreDataIndexer->getCountOfUsersByCondition('Marshall Islands', 'M', true, false));
        $this->assertSame(20, $this->scoreDataIndexer->getCountOfUsersByCondition('Barbados', 'O', true, true));
    }
}
