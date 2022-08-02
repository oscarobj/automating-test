<?php

namespace Tests\Unit;

use App\services\NaturalNumbersService;
use Tests\TestCase;

class MultiplesOfThreeAndFiveTest extends TestCase
{
    private int $min = 0;

    /**
     * @test
     */
    public function givenGetMultiplesOfThreeOrFiveWhenBelowTenThenReturnsFiveNumbers()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 10;
        $expected = [
            0 => 0,
            1 => 3,
            2 => 5,
            3 => 6,
            4 => 9,
        ];

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFive($this->min, $max);

        $this->assertEquals($expected, $multiples);
    }

    /**
     * @test
     */
    public function givenGetMultiplesOfThreeAndFiveWhenBelowThirtyOneReturnsThreeNumbers()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 31;
        $expected = [
            0 => 0,
            1 => 15,
            2 => 30,
        ];

        $multiples = $naturalNumbersService->getMultiplesOfTreeAndFive($this->min, $max);

        $this->assertEquals($expected, $multiples);
    }

    /**
     * @test
     */
    public function givenGetMultiplesOfThreeAndSevenWhenBelowThirtySixThenReturnsTreeNumbers()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 36;
        $expected = [
            0 => 0,
            1 => 21,
            2 => 35,
        ];

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFiveAndSeven($this->min, $max);

        $this->assertEquals($expected, $multiples);
    }


    /**
     * @test
     */
    public function givenSumMultiplesOfThreeOrFiveWhenBelowTenThenReturnsTwentyTree()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 10;
        $expected = 23;

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFive($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        $this->assertEquals($expected, $sumOfMultiples);
    }

    /**
     * @test
     */
    public function givenSumMultiplesOfThreeAndFiveWhenBelowThirtyOneThenReturnsFortyFive()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 31;
        $expected = 45;

        $multiples = $naturalNumbersService->getMultiplesOfTreeAndFive($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        $this->assertEquals($expected, $sumOfMultiples);
    }

    /**
     * @test
     */
    public function givenSumMultiplesOfThreeOrFiveAndSevenWhenBelowThirtySixThenReturnsFiftySix()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 36;
        $expected = 56;

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFiveAndSeven($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        $this->assertEquals($expected, $sumOfMultiples);
    }
}
