<?php

namespace Tests\Unit;

use App\services\NaturalNumbersService;
use App\services\WordsToNumbersService;
use Mockery;
use PHPUnit\Framework\TestCase;

class WordsToNumbersTest extends TestCase
{
    /**
     * @test
     */
    public function givenCheckLetterTranslationWhenLetterIsPThenReturnsFortyTwo()
    {
        $naturalNumbersService = Mockery::mock(NaturalNumbersService::class);
        $wordsToNumbersService = new WordsToNumbersService($naturalNumbersService);
        $letter = 'P';
        $expected = 42;

        $result = $wordsToNumbersService->translateLetter($letter);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function givenWordSplitWhenWordIsAnaThenReturnsAAndNAndA()
    {
        $naturalNumbersService = Mockery::mock(NaturalNumbersService::class);
        $wordsToNumbersService = new WordsToNumbersService($naturalNumbersService);
        $word = 'Ana';
        $expected = [
            0 => 'A',
            1 => 'n',
            2 => 'a',
        ];

        $result = $wordsToNumbersService->splitWordLetters($word);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function givenTestWordTranslationWhenWordIsAboboraThenReturnsOneHundredFiftyEight()
    {
        $naturalNumbersService = Mockery::mock(NaturalNumbersService::class);
        $wordsToNumbersService = new WordsToNumbersService($naturalNumbersService);
        $word = 'AbObORa';
        $expected = 27 + 2 + 41 + 2 + 41 + 44 + 1;

        $sum = $wordsToNumbersService->translateWordToAlphabetSum($word);

        $this->assertEquals($expected, $sum);
    }

    /**
     * @test
     */
    public function givenCheckIfNumberIsPrimeWhenNumbersAreElevenAndFourThenReturnsTrueAndFalseRespectively()
    {
        $naturalNumbersService = Mockery::mock(NaturalNumbersService::class);
        $wordsToNumbersService = new WordsToNumbersService($naturalNumbersService);
        $primeNumber = 11;
        $notPrimeNumber = 4;

        $isPrime = $wordsToNumbersService->isPrime($primeNumber);
        $isNotPrime = $wordsToNumbersService->isPrime($notPrimeNumber);

        $this->assertTrue($isPrime);
        $this->assertFalse($isNotPrime);
    }

    /**
     * @test
     */
    public function givenCheckIfWordInfoWorksWhenWordsAreBeAndBiAndEEEThenReturnsExpected()
    {
        $naturalNumbersService = new NaturalNumbersService();
        $wordsToNumbersService = new WordsToNumbersService($naturalNumbersService);

        $happy = 'be'; // 7 (também é primo)
        $prime = 'bi'; // 11 (é primo mas não é feliz)
        $multipleOf3Or5 = 'eee'; // 15 (não é primo nem feliz)

        $expectedIsHappy = [
            'isHappy' => true,
            'isMultipleOf3or5' => false,
            'isPrime' => true,
        ];

        $expectedIsPrime = [
            'isPrime' => true,
            'isHappy' => false,
            'isMultipleOf3or5' => false,
        ];

        $expectedIsMultiple = [
            'isMultipleOf3or5' => true,
            'isPrime' => false,
            'isHappy' => false,
        ];

        $isHappy = $wordsToNumbersService->getWordInfo($happy);
        $isPrime = $wordsToNumbersService->getWordInfo($prime);
        $isMultipleOf3Or5 = $wordsToNumbersService->getWordInfo($multipleOf3Or5);

        $this->assertEquals($expectedIsHappy, $isHappy);
        $this->assertEquals($expectedIsPrime, $isPrime);
        $this->assertEquals($expectedIsMultiple, $isMultipleOf3Or5);
    }
}
