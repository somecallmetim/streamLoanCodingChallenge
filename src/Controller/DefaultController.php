<?php


namespace App\Controller;


use App\service\ScoreDataIndexer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="app_homepage")
     */
    public function homepage(ScoreDataIndexer $scoreDataIndexer){
        $count = $scoreDataIndexer->getCountOfUsersWithinScoreRange(-50, 50);
        return new Response($count);
    }
}