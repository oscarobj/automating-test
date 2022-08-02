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
        // Arrange
        $naturalNumbersService = new NaturalNumbersService();
        $max = 10;
        $expected = [
            0 => 0,
            1 => 3,
            2 => 5,
            3 => 6,
            4 => 9,
        ];

        // Act
        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFive($this->min, $max);

        // Assert
        $this->assertEquals($expected, $multiples);
    }

    /**
     * @test
     */
    public function givenGetMultiplesOfThreeAndFiveWhenBelowThirtyOneReturnsThreeNumbers()
    {
        // Arrange
        $naturalNumbersService = new NaturalNumbersService();
        $max = 31;
        $expected = [
            0 => 0,
            1 => 15,
            2 => 30,
        ];

        // Act
        $multiples = $naturalNumbersService->getMultiplesOfTreeAndFive($this->min, $max);

        // Assert
        $this->assertEquals($expected, $multiples);
    }

    /**
     * @test
     */
    public function givenGetMultiplesOfThreeAndSevenWhenBelowThirtySixThenReturnsTreeNumbers()
    {
        // Arrange
        $naturalNumbersService = new NaturalNumbersService();
        $max = 36;
        $expected = [
            0 => 0,
            1 => 21,
            2 => 35,
        ];

        // Act
        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFiveAndSeven($this->min, $max);

        // Assert
        $this->assertEquals($expected, $multiples);
    }


    /**
     * @test
     */
    public function givenSumMultiplesOfThreeOrFiveWhenBelowTenThenReturnsTwentyTree()
    {
        // Arrange
        $naturalNumbersService = new NaturalNumbersService();
        $max = 10;
        $expected = 23;

        // Act
        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFive($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        // Assert
        $this->assertEquals($expected, $sumOfMultiples);
    }

    /**
     * @test
     */
    public function givenSumMultiplesOfThreeAndFiveWhenBelowThirtyOneThenReturnsFortyFive()
    {
        // Arrange
        $naturalNumbersService = new NaturalNumbersService();
        $max = 31;
        $expected = 45;

        // Act
        $multiples = $naturalNumbersService->getMultiplesOfTreeAndFive($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        // Assert
        $this->assertEquals($expected, $sumOfMultiples);
    }

    /**
     * @test
     */
    public function givenSumMultiplesOfThreeOrFiveAndSevenWhenBelowThirtySixThenReturnsFiftySix()
    {
        // Arrange
        $naturalNumbersService = new NaturalNumbersService();
        $max = 36;
        $expected = 56;

        // Act
        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFiveAndSeven($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        // Assert
        $this->assertEquals($expected, $sumOfMultiples);
    }
}
