<?php

namespace App\services;

class NaturalNumbersService
{
    /**
     * @param int $minValue
     * @param int $maxValue
     * @return array
     * O método retorna os múltiplos de três OU cinco
     */
    public function getMultiplesOfTreeOrFive(int $minValue, int $maxValue): array
    {
        $multiples = [];
        $count = $minValue;

        while ($count < $maxValue) {

            if ($count % 3 == 0 || $count % 5 == 0)
                $multiples[] = $count;

            $count++;
        }

        return $multiples;
    }

    /**
     * @param int $minValue
     * @param int $maxValue
     * @return array
     * O método retorna os múltiplos de três E cinco
     */
    public function getMultiplesOfTreeAndFive(int $minValue, int $maxValue): array
    {
        $multiples = [];
        $count = $minValue;

        while ($count < $maxValue) {

            if ($count % 3 == 0 && $count % 5 == 0)
                $multiples[] = $count;

            $count++;
        }

        return $multiples;
    }

    /**
     * @param int $minValue
     * @param int $maxValue
     * @return array
     * O método retorna os múltiplos de (três OU cinco) e 7
     */
    public function getMultiplesOfTreeOrFiveAndSeven(int $minValue, int $maxValue): array
    {
        $multiples = [];
        $count = $minValue;

        while ($count < $maxValue) {

            if (($count % 3 == 0 || $count % 5 == 0) && $count % 7 == 0)
                $multiples[] = $count;

            $count++;
        }

        return $multiples;
    }

    public function sumMultiples(array $multilples): int
    {
        $sum = 0;

        foreach ($multilples as $multilple) {
            $sum+= $multilple;
        }

        return $sum;
    }
}
