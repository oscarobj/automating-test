<?php

namespace Tests\Unit;

use App\services\NaturalNumbersService;
use App\services\WordsToNumbersService;
use PHPUnit\Framework\TestCase;

class WordsToNumbers extends TestCase
{
    /**
     * @test
     * Testar a tradução de uma letra
     */
    public function testLetterTranslation()
    {
        $wordsToNumbersService = new WordsToNumbersService();

        $letter = 'P';
        $expected = 42;
        $result = $wordsToNumbersService->translateLetter($letter);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * Testar a separação de letras em um array
     */
    public function testWordSplit()
    {
        $wordsToNumbersService = new WordsToNumbersService();

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
     * Testar a tradução (soma das letras) de uma palavra
     */
    public function testWordTranslation()
    {
        $wordsToNumbersService = new WordsToNumbersService();

        $word = 'AbObORa';
        $expected = 27 + 2 + 41 + 2 + 41 + 44 + 1;
        $sum = $wordsToNumbersService->translateWordToAlphabetSum($word);

        $this->assertEquals($expected, $sum);
    }

    /**
     * @test
     * Testar se o número é múltiplo de 3 ou 5
     */
    public function checkIfNumberIsPrime()
    {
        $wordsToNumbersService = new WordsToNumbersService();

        $primeNumber = 11;
        $notPrimeNumber = 4;

        $this->assertTrue($wordsToNumbersService->isPrime($primeNumber));
        $this->assertFalse($wordsToNumbersService->isPrime($notPrimeNumber));
    }

    /**
     * @test
     * Testar se o número é múltiplo de 3 ou 5
     */
    public function checkIfNumberIsMultipleOf3Or5()
    {
        $wordsToNumbersService = new WordsToNumbersService();

        $multipleNumber = 30;
        $notMultipleNumber = 2;

        $this->assertTrue($wordsToNumbersService->isMultipleOf3Or5($multipleNumber));
        $this->assertFalse($wordsToNumbersService->isMultipleOf3Or5($notMultipleNumber));
    }

    /**
     * @test
     * Testar se a tradução da palavra é primo, múltiplo de 3 ou 5 E número feliz
     */
    public function checkIfWordInfoWorks()
    {
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

        $this->assertEquals($expectedIsHappy, $wordsToNumbersService->getWordInfo($happy));
        $this->assertEquals($expectedIsPrime, $wordsToNumbersService->getWordInfo($prime));
        $this->assertEquals($expectedIsMultiple, $wordsToNumbersService->getWordInfo($multipleOf3Or5));
    }
}
