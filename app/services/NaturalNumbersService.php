<?php

namespace App\services;

use App\Http\Enums\NaturalNumbersEnum;
use Exception;

class NaturalNumbersService
{
    /**
     * @param int $minValue
     * @param int $maxValue
     * @return array
     * @throws Exception
     */
    public function getMultiplesOfTreeOrFive(int $minValue, int $maxValue): array
    {
        return $this->getCountOfMultiples($minValue, $maxValue, NaturalNumbersEnum::MultiplesOfXOrY);
    }

    /**
     * @param int $minValue
     * @param int $maxValue
     * @return array
     * @throws Exception
     */
    public function getMultiplesOfTreeAndFive(int $minValue, int $maxValue): array
    {
        return $this->getCountOfMultiples($minValue, $maxValue, NaturalNumbersEnum::MultiplesOfXAndY);
    }

    /**
     * @param int $minValue
     * @param int $maxValue
     * @return array
     * @throws Exception
     */
    public function getMultiplesOfTreeOrFiveAndSeven(int $minValue, int $maxValue): array
    {
        return $this->getCountOfMultiples($minValue, $maxValue, NaturalNumbersEnum::MultiplesOfXOrYAndZ);
    }

    /**
     * @param array $multilples
     * @return int
     */
    public function sumMultiples(array $multilples): int
    {
        $sum = 0;

        foreach ($multilples as $multilple) {
            $sum += $multilple;
        }

        return $sum;
    }

    /**
     * @throws Exception
     */
    public function getCountOfMultiples(int $count, int $maxValue, NaturalNumbersEnum $operation): array
    {
        $multiples = [];

        while ($count < $maxValue) {

            switch ($operation) {

                case NaturalNumbersEnum::MultiplesOfXOrY:
                    if ($count % 3 == 0 || $count % 5 == 0)
                        $multiples[] = $count;
                    break;

                case NaturalNumbersEnum::MultiplesOfXAndY:
                    if ($count % 3 == 0 && $count % 5 == 0)
                        $multiples[] = $count;
                    break;

                case NaturalNumbersEnum::MultiplesOfXOrYAndZ:
                    if (($count % 3 == 0 || $count % 5 == 0) && $count % 7 == 0)
                        $multiples[] = $count;
                    break;

                default:
                    throw new Exception('Operação inválida');
            }

            $count++;
        }

        return $multiples;
    }
}
