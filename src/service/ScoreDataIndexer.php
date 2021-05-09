<?php


namespace App\service;

use App\Interfaces\ScoreDataIndexerInterface;
use League\Csv\Reader;

class ScoreDataIndexer implements ScoreDataIndexerInterface
{
    private $csvReader;
    private $dataFilePath;

    // makes sure there's data to read when the service is instantiated
        // $dataFilePath is setup in services.yaml & gives path to "medium sized" csv file
    public function __construct(string $dataFilePath){
        $this->dataFilePath = $dataFilePath;
        $this->csvReader = Reader::createFromPath($dataFilePath);
        $this->csvReader->setHeaderOffset(0);
    }

    public function getDataSource(){
        return $this->dataFilePath;
    }

    public function setDataSource(string $path){
        $this->csvReader = Reader::createFromPath($path);
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
            // checks if score is between the two values given
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
            // checks if the legal age requirement that's been requested matches the age for the current row
            if(($hasLegalAge && $age >= 18) or (!$hasLegalAge && $age < 18)){
                // checks if the score is positive or negative and whether that matches search condition
                if(($hasPositiveScore && $score > 0) or (!$hasPositiveScore && $score <= 0)){
                    // check if region & gender match the search term that's been requested
                    if($region == $row['region'] && $gender == $row['gender']){
                        $count++;
                    }
                }
            }
        }
        return $count;
    }
}