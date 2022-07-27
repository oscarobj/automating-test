<?php

namespace App\services;

class WordsToNumbersService
{
    public function setAlphabetToNumbers(): array
    {
        return [
            'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5,
            'f' => 6, 'g' => 7, 'h' => 8, 'i' => 9, 'j' => 10,
            'k' => 11, 'l' => 12, 'm' => 13, 'n' => 14, 'o' => 15,
            'p' => 16, 'q' => 17, 'r' => 18, 's' => 19, 't' => 20,
            'u' => 21, 'v' => 22, 'w' => 23, 'x' => 24, 'y' => 25, 'z' => 26,
            'A' => 27, 'B' => 28, 'C' => 29, 'D' => 30, 'E' => 31, 'F' => 32,
            'G' => 33, 'H' => 34, 'I' => 35, 'J' => 36, 'K' => 37, 'L' => 38,
            'M' => 39, 'N' => 40, 'O' => 41, 'P' => 42, 'Q' => 43, 'R' => 44,
            'S' => 45, 'T' => 46, 'U' => 47, 'V' => 48, 'W' => 49, 'X' => 50, 'Y' => 51, 'Z' => 52,
        ];
    }

    public function translateWordToAlphabetSum(string $word): int
    {
        $happyNumbersService = new HappyNumberService();

        $sum = [];
        $letters = $this->splitWordLetters($word);

        foreach ($letters as $letter) {
            $sum[] = $this->translateLetter($letter);
        }

        return $happyNumbersService->sumNumbers($sum);
    }

    public function splitWordLetters(string $word): array
    {
        return str_split($word);
    }

    public function translateLetter($letter): ?int
    {
        $alphabet = $this->setAlphabetToNumbers();

        return $alphabet[$letter] ?? null;
    }

    public function isPrime(int $number): bool
    {
        return gmp_prob_prime($number);
    }

    public function isMultipleOf3Or5(int $number): bool
    {
        return $number % 3 == 0 || $number % 5 == 0;
    }

    public function getWordInfo(string $word): array
    {
        $happyNumberService = new HappyNumberService();

        $sum = $this->translateWordToAlphabetSum($word);

        return [
            'isMultipleOf3or5' => $this->isMultipleOf3Or5($sum),
            'isPrime' => $this->isPrime($sum),
            'isHappy' => $happyNumberService->isHappyNumber($sum)
        ];
    }

}
