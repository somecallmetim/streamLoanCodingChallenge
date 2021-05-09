<?php


namespace App\service;

use App\Interfaces\ScoreDataIndexerInterface;
use League\Csv\Reader;

class ScoreDataIndexer implements ScoreDataIndexerInterface
{
    private $csvReader;

    // makes sure there's data to read when the service is instantiated
    public function __construct(){
        $this->csvReader = Reader::createFromPath('%kernel.root.dir%/data/data.csv');
        $this->csvReader->setHeaderOffset(0);
    }

    /**
     * Returns count of users having score within the interval.
     *
     * @param int $rangeStart
     * @param int $rangeEnd
     * @return int
     */
    public function getCountOfUsersWithinScoreRange(int $rangeStart, int $rangeEnd): int
    {
        $count = 0;
        // loops through csvReader and counts all users who meet the score requirement
        foreach ($this->csvReader as $row){
            // set this manually because a type conversion will have to happen regardless
                // this way it's explicit and easier to read
            $score = intval($row['score']);
            if($score >= $rangeStart && $score <= $rangeEnd){
                $count++;
            }
        }
        return $count;
    }

    /**
     * Returns count of users who meet input condition.
     *
     * @param string $region
     * @param string $gender
     * @param bool $hasLegalAge
     * @param bool $hasPositiveScore
     * @return int
     */
    public function getCountOfUsersByCondition(string $region, string $gender, bool $hasLegalAge, bool $hasPositiveScore): int
    {
        $count = 0;
        // loops through csvReader and counts all users who meet the requirements
        foreach ($this->csvReader as $row){
            // set these manually because a type conversion will have to happen regardless
                // this way it's explicit and easier to read
            $score = intval($row['score']);
            $age = intval($row['age']);
            if(($hasLegalAge && $age >= 18) or (!$hasLegalAge && $age < 18)){
                if($region == $row['region'] && $gender == $row['gender'] && $score > 0){
                    $count++;
                }
            }
        }
        return $count;
    }
}