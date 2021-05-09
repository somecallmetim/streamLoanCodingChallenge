<?php

namespace App\Interfaces;

interface ScoreDataIndexerInterface
{
    /**
     * Returns count of users having score within the interval.
     *
     * @param int $rangeStart
     * @param int $rangeEnd
     * @return int
     */
    public function getCountOfUsersWithinScoreRange(
        int $rangeStart,
        int $rangeEnd
    ): int;
    /**
     * Returns count of users who meet input condition.
     *
     * @param string $region
     * @param string $gender
     * @param bool $hasLegalAge
     * @param bool $hasPositiveScore
     * @return int
     */
    public function getCountOfUsersByCondition(
        string $region,
        string $gender,
        bool $hasLegalAge,
        bool $hasPositiveScore
    ): int;
}
