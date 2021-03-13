<?php

namespace Brain\Games\Games;

use function Brain\Games\Engine\game;

const RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const MIN_VALUE = 0;
const MAX_VALUE = 999;

function brainPrime(): void
{
    game(
        function (): string {
            $number = rand(MIN_VALUE, MAX_VALUE);
            echo("Question: $number" . PHP_EOL);
            return isPrime($number) ? 'yes' : 'no';
        },
        RULES
    );
}

function isPrime(int $number): bool
{
    $assumption = floor($number / 2) + 1;
    for ($i = $assumption; $i > 1; $i--) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}
