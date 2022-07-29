<?php

namespace Tests\Unit;

use App\services\HappyNumberService;
use Tests\TestCase;

class HappyNumbersTest extends TestCase
{
    /** @test
     * separar as partes de um inteiro
     */
    public function splitInteger()
    {
        // Arrange
        $happyNumberService = new HappyNumberService();
        $number = 12;
        $expected = [
            0 => 1,
            1 => 2,
        ];

        // Act
        $split = $happyNumberService->splitInteger($number);

        // Assert
        $this->assertEquals($expected, $split);
    }

    /** @test
     * elevar ao quadrado os numeros de um array
     */
    public function squareNumbers()
    {
        // Arrange
        $happyNumberService = new HappyNumberService();
        $entry = [
            0 => 1,
            1 => 2,
        ];
        $expected = [
            0 => 1,
            1 => 4,
        ];

        // Act
        $split = $happyNumberService->squareNumbers($entry);

        // Assert
        $this->assertEquals($expected, $split);
    }

    /** @test
     * somar os números de um array
     */
    public function sumNumbers()
    {
        // Arrange
        $happyNumberService = new HappyNumberService();
        $numbers = [
            0 => 1,
            1 => 4,
        ];
        $expected = 5;

        // Act
        $sum = $happyNumberService->sumNumbers($numbers);

        // Assert
        $this->assertEquals($expected, $sum);
    }

    /** @test
     * Verify is a happy number
     */
    public function verifiyIfIsAHappyNumber()
    {
        // Arrange
        $happyNumberService = new HappyNumberService();
        $happyNumber = 7;
        $notHappyNumber = 15;

        // Act
        $isAHappyNumber = $happyNumberService->isHappyNumber($happyNumber);
        $isNotAHappyNumber = $happyNumberService->isHappyNumber($notHappyNumber);

        // Assert
        $this->assertTrue($isAHappyNumber);
        $this->assertFalse($isNotAHappyNumber);
    }
}
