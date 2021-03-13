<?php

namespace Brain\Games\Games\Even;

use function Brain\Games\Engine\game;

const RULES = 'Answer "yes" if the number is even, otherwise answer "no"';
const MIN_VALUE = 0;
const MAX_VALUE = 999;

function brainEven(): void
{
    game(
        function (): string {
            $number = rand(MIN_VALUE, MAX_VALUE);
            echo("Question: $number" . PHP_EOL);
            return isEven($number) ? 'yes' : 'no';
        },
        RULES
    );
}

function isEven(int $num): bool
{
    return $num % 2 == 0;
}
