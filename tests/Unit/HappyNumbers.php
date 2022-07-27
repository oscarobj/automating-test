<?php

namespace Tests\Unit;

use App\services\HappyNumberService;
use Tests\TestCase;

class HappyNumbers extends TestCase
{
    /** @test
     * separar as partes de um inteiro
     */
    public function splitInteger()
    {
        $happyNumberService = new HappyNumberService();
        $number = 12;
        $expected = [
            0 => 1,
            1 => 2,
        ];

        $this->assertEquals($expected, $happyNumberService->splitInteger($number));
    }

    /** @test
     * elevar ao quadrado os numeros de um array
     */
    public function squareNumbers()
    {
        $happyNumberService = new HappyNumberService();

        $entry = [
            0 => 1,
            1 => 2,
        ];

        $split = $happyNumberService->squareNumbers($entry);

        $expected = [
            0 => 1,
            1 => 4,
        ];

        $this->assertEquals($expected, $split);
    }

    /** @test
     * somar os números de um array
     */
    public function sumNumbers()
    {
        $happyNumberService = new HappyNumberService();

        $numbers = [
            0 => 1,
            1 => 4,
        ];

        $expected = 5;
        $sum = $happyNumberService->sumNumbers($numbers);

        $this->assertEquals($expected, $sum);
    }

    /** @test
     * Verify is a happy number
     */
    public function verifiyIfIsAHappyNumber()
    {
        $happyNumberService = new HappyNumberService();

        $happyNumber = 7;
        $isAHappyNumber = $happyNumberService->isHappyNumber($happyNumber);

        $this->assertTrue($isAHappyNumber);
    }
}
