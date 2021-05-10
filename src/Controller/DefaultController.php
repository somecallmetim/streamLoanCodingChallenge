<?php


namespace App\Controller;


use App\Entity\Branch;
use App\Repository\BranchRepository;
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

    /**
     * @Route("/query", name="app_requested_query")
     */
    public function requestedQuery(){
        $country = "JP";
        $state = "CT";
        $branchAverage = $this->getDoctrine()
            ->getManager()
            ->getRepository(Branch::class)
            ->findByCountryAndStateThenGiveAverageActiveLoanValue($country, $state);
        $roundedFloat = round($branchAverage[0]['AVG(`value`)'], 2);
        $averageValueStr = "Average Value of Local Branch Loans is: \$".strval($roundedFloat);
        return new Response($averageValueStr);
    }
}