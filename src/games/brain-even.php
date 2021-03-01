<?php

namespace Brain\Games\Games;

use function Brain\Games\Engine\game;

const RULES = 'Answer "yes" if the number is even, otherwise answer "no"';
const MIN_VALUE = 0;
const MAX_VALUE = 999;

function brainEven()
{
    game(
        function () {
            $number = rand(MIN_VALUE, MAX_VALUE);
            echo("Question: $number" . PHP_EOL);
            return isEven($number) ? 'yes' : 'no';
        },
        RULES
    );
}

function isEven(int $num)
{
    return $num % 2 == 0;
}
