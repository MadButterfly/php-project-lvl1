<?php

namespace Brain\Games\Games\Gcd;

use function Brain\Games\Engine\game;

const RULES = 'Find the greatest common divisor of given numbers.';
const MIN_VALUE = 1;
const MAX_VALUE = 99;

function brainGcd(): void
{
    game(
        function (): int {
            $firstNum = rand(MIN_VALUE, MAX_VALUE);
            $secondNum = rand(MIN_VALUE, MAX_VALUE);
            echo("Question: $firstNum $secondNum" . PHP_EOL);
            return getGcd($firstNum, $secondNum);
        },
        RULES
    );
}

function getGcd(int $firstNum, int $secondNum): int
{
    // if numbers are equal - return the first one
    if ($firstNum === $secondNum) {
        return $firstNum;
    }
    // otherwise start checking from half of minimal value rounded down + 1
    $min = $firstNum < $secondNum ? $firstNum : $secondNum;
    $assumption = floor($min / 2) + 1;
    for ($i = $assumption; $i > 0; $i--) {
        if ($firstNum % $i == 0 && $secondNum % $i == 0) {
            $result = $i;
            break;
        }
    }
    return $i;
}
