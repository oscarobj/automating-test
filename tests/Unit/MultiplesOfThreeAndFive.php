<?php

namespace Tests\Unit;

use App\services\NaturalNumbersService;
use Tests\TestCase;

class MultiplesOfThreeAndFive extends TestCase
{
    private int $min = 0;

    /** @test
     * verificar array com os múltiplos de três OU (||) cinco dos números naturais abaixo de 10
     */
    public function getMultiplesOfThreeOrFiveBelow10()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 10;

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFive($this->min, $max);
        $expected = [
            0 => 0,
            1 => 3,
            2 => 5,
            3 => 6,
            4 => 9,
        ];

        $this->assertEquals($expected, $multiples);
    }

    /** @test
     * verificar array com os múltiplos de três E (&&) cinco dos números naturais abaixo de 31
     */
    public function getMultiplesOfThreeAndFiveBelow31()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 31;

        $multiples = $naturalNumbersService->getMultiplesOfTreeAndFive($this->min, $max);
        $expected = [
            0 => 0,
            1 => 15,
            2 => 30,
        ];

        $this->assertEquals($expected, $multiples);
    }

    /** @test
     * verificar array com os múltiplos de (três OU (||) cinco) E 7 dos números naturais abaixo de 36
     */
    public function getMultiplesOfThreeAndSevenBelow36()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 36;

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFiveAndSeven($this->min, $max);
        $expected = [
            0 => 0,
            1 => 21,
            2 => 35,
        ];

        $this->assertEquals($expected, $multiples);
    }


    /** @test
     * Soma dos múltiplos de três E cinco dos números naturais abaixo de 10
     */
    public function sumMultiplesOfThreeOrFiveBelow10()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 10;

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFive($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        $expected = 23;

        $this->assertEquals($expected, $sumOfMultiples);
    }

    /** @test
     * Soma dos múltiplos de três E cinco dos números naturais abaixo de 1000
     */
    public function sumMultiplesOfThreeAndFiveBelow31()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 31;

        $multiples = $naturalNumbersService->getMultiplesOfTreeAndFive($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        $expected = 45;

        $this->assertEquals($expected, $sumOfMultiples);
    }

    /** @test
     * Soma dos múltiplos de (três OU cinco) E 7 dos números naturais abaixo de 36
     */
    public function sumMultiplesOfThreeOrFiveAndSevenBelow36()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $max = 36;

        $multiples = $naturalNumbersService->getMultiplesOfTreeOrFiveAndSeven($this->min, $max);
        $sumOfMultiples = $naturalNumbersService->sumMultiples($multiples);

        $expected = 56;

        $this->assertEquals($expected, $sumOfMultiples);
    }
}
