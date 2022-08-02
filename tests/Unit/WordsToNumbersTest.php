<?php

namespace Tests\Unit;

use App\services\NaturalNumbersService;
use App\services\WordsToNumbersService;
use PHPUnit\Framework\TestCase;

class WordsToNumbersTest extends TestCase
{
    /**
     * @test
     * Testar a tradução de uma letra
     */
    public function givenCheckLetterTranslationWhenLetterIsPThenReturnsFortyTwo()
    {
        // Arrange
        $wordsToNumbersService = new WordsToNumbersService();
        $letter = 'P';
        $expected = 42;

        // Act
        $result = $wordsToNumbersService->translateLetter($letter);

        // Assert
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * Testar a separação de letras em um array
     */
    public function givenWordSplitWhenWordIsAnaThenReturnsAAndNAndA()
    {
        // Arrange
        $wordsToNumbersService = new WordsToNumbersService();
        $word = 'Ana';
        $expected = [
            0 => 'A',
            1 => 'n',
            2 => 'a',
        ];

        //Act
        $result = $wordsToNumbersService->splitWordLetters($word);

        //Assert
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * Testar a tradução (soma das letras) de uma palavra
     */
    public function givenTestWordTranslationWhenWordIsAboboraThenReturnsOneHundredFiftyEight()
    {
        // Arrange
        $wordsToNumbersService = new WordsToNumbersService();
        $word = 'AbObORa';
        $expected = 27 + 2 + 41 + 2 + 41 + 44 + 1;

        // Act
        $sum = $wordsToNumbersService->translateWordToAlphabetSum($word);

        // Assert
        $this->assertEquals($expected, $sum);
    }

    /**
     * @test
     * Testar se o número é múltiplo de 3 ou 5
     */
    public function givenCheckIfNumberIsPrimeWhenNumbersAreElevenAndFourThenReturnsTrueAndFalseRespectively()
    {
        // Arrange
        $wordsToNumbersService = new WordsToNumbersService();
        $primeNumber = 11;
        $notPrimeNumber = 4;

        // Act
        $isPrime = $wordsToNumbersService->isPrime($primeNumber);
        $isNotPrime = $wordsToNumbersService->isPrime($notPrimeNumber);

        // Assert
        $this->assertTrue($isPrime);
        $this->assertFalse($isNotPrime);
    }

    /**
     * @test
     * Testar se o número é múltiplo de 3 ou 5
     */
    public function givenCheckIfNumberIsMultipleOfThreeOrFiveWhenMultiplesNumberAreTirtyAndTwoThenReturnsTrueAndFalseRespectively()
    {
        // Arrange
        $wordsToNumbersService = new WordsToNumbersService();
        $multipleNumber = 30;
        $notMultipleNumber = 2;

        // Act
        $isMultipleNumber = $wordsToNumbersService->isMultipleOf3Or5($multipleNumber);
        $isNotMultipleNumber = $wordsToNumbersService->isMultipleOf3Or5($notMultipleNumber);
        // Assert
        $this->assertTrue($isMultipleNumber);
        $this->assertFalse($isNotMultipleNumber);
    }

    /**
     * @test
     * Testar se a tradução da palavra é primo, múltiplo de 3 ou 5 E número feliz
     */
    public function givenCheckIfWordInfoWorksWhenWordsAreBeAndBiAndEEEThenReturnsExpected()
    {
        // Arrange

        $wordsToNumbersService = new WordsToNumbersService();

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

        // Act
        $isHappy = $wordsToNumbersService->getWordInfo($happy);
        $isPrime = $wordsToNumbersService->getWordInfo($prime);
        $isMultipleOf3Or5 = $wordsToNumbersService->getWordInfo($multipleOf3Or5);

        // Assert
        $this->assertEquals($expectedIsHappy, $isHappy);
        $this->assertEquals($expectedIsPrime, $isPrime);
        $this->assertEquals($expectedIsMultiple, $isMultipleOf3Or5);
    }
}
