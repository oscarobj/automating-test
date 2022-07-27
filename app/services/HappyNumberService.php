<?php

namespace App\services;

class HappyNumberService
{
    public function splitInteger(int $number): array
    {
        return str_split($number);
    }

    public function squareNumbers(array $numbers): array
    {
        $squareNumbers = [];

        foreach ($numbers as $number) {
            $squareNumbers[] = $number * $number;
        }

        return $squareNumbers;
    }

    public function sumNumbers(array $numbers)
    {
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += $number;
        }

        return $sum;
    }

    public function isHappyNumber($number): bool
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
