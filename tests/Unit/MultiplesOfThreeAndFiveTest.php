<?php

namespace Tests\Unit;

use App\services\NaturalNumbersService;
use Tests\TestCase;

class MultiplesOfThreeAndFiveTest extends TestCase
{
    private int $min = 0;

    /** @test
     * verificar array com os múltiplos de três OU (||) cinco dos números naturais abaixo de 10
     */
    public function getMultiplesOfThreeOrFiveBelow10()
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

    /** @test
     * verificar array com os múltiplos de três E (&&) cinco dos números naturais abaixo de 31
     */
    public function getMultiplesOfThreeAndFiveBelow31()
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

    /** @test
     * verificar array com os múltiplos de (três OU (||) cinco) E 7 dos números naturais abaixo de 36
     */
    public function getMultiplesOfThreeAndSevenBelow36()
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


    /** @test
     * Soma dos múltiplos de três E cinco dos números naturais abaixo de 10
     */
    public function sumMultiplesOfThreeOrFiveBelow10()
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

    /** @test
     * Soma dos múltiplos de três E cinco dos números naturais abaixo de 1000
     */
    public function sumMultiplesOfThreeAndFiveBelow31()
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

    /** @test
     * Soma dos múltiplos de (três OU cinco) E 7 dos números naturais abaixo de 36
     */
    public function sumMultiplesOfThreeOrFiveAndSevenBelow36()
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
