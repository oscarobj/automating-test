<?php

namespace App\services;

class HappyNumberService
{
    /**
     * @param int $number
     * @return array
     */
    public function splitInteger(int $number): array
    {
        return str_split($number);
    }

    /**
     * @param array $numbers
     * @return array
     */
    public function squareNumbers(array $numbers): array
    {
        $squareNumbers = [];

        foreach ($numbers as $number) {
            $squareNumbers[] = $number * $number;
        }

        return $squareNumbers;
    }

    /**
     * @param array $numbers
     * @return int
     */
    public function sumNumbers(array $numbers): int
    {
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += $number;
        }

        return $sum;
    }

    /**
     * @param int $number
     * @return bool
     */
    public function isHappyNumber(int $number): bool
    {
        $count = 0;
        $maxOperations = 1000;

        while ($number != 1) {
            $split = $this->splitInteger($number);
            $square = $this->squareNumbers($split);
            $sum = $this->sumNumbers($square);

            $number = $sum;
            $count++;

            if ($count == $maxOperations) {
                return false;
            }
        }

        return true;
    }
}
