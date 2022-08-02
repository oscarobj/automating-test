<?php

namespace Tests\Unit;

use App\services\HappyNumberService;
use Tests\TestCase;

class HappyNumbersTest extends TestCase
{
    /**
     * @test
     */
    public function givenSplitIntegerWhenNumberIsTwelveThenReturnsTwoNumbers()
    {
        $happyNumberService = new HappyNumberService();
        $number = 12;
        $expected = [
            0 => 1,
            1 => 2,
        ];

        $split = $happyNumberService->splitInteger($number);

        $this->assertEquals($expected, $split);
    }

    /**
     * @test
     */
    public function givenSquareNumbersWhenEntryIsOneAndTwoThenReturnsOneAndFour()
    {
        $happyNumberService = new HappyNumberService();
        $entry = [
            0 => 1,
            1 => 2,
        ];
        $expected = [
            0 => 1,
            1 => 4,
        ];

        $split = $happyNumberService->squareNumbers($entry);

        $this->assertEquals($expected, $split);
    }

    /**
     * @test
     */
    public function givenSumNumbersWhenAreOneAndFourThenReturnsFive()
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

    /**
     * @test
     */
    public function givenCheckIfIsAHappyNumberWhenNumberIsSevenAndFifteenAndReturnsTrueAndFalseRespectively()
    {
        $happyNumberService = new HappyNumberService();
        $happyNumber = 7;
        $notHappyNumber = 15;

        $isAHappyNumber = $happyNumberService->isHappyNumber($happyNumber);
        $isNotAHappyNumber = $happyNumberService->isHappyNumber($notHappyNumber);

        $this->assertTrue($isAHappyNumber);
        $this->assertFalse($isNotAHappyNumber);
    }
}
