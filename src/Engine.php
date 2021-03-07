<?php

namespace Brain\Games\Engine;

use function Brain\Games\Cli\greetings;
use function cli\prompt;
use function cli\line;

const TRIES = 3;

function game(callable $gameRound, string $rules): void
{
    $correctAnswers = 0;
    $userName = greetings();
    line($rules);

    while ($correctAnswers < TRIES) {
        $expectedAnswer = $gameRound();
        $actualAnswer = prompt('Your answer');
        $isCorrect = strval($expectedAnswer) === strtolower($actualAnswer);
        if ($isCorrect) {
            line("Correct!");
            $correctAnswers += 1;
        } else {
            line(
                "'$actualAnswer' is wrong answer ;(. Correct answer was '$expectedAnswer'."
                . PHP_EOL . "Let's try again, $userName!"
            );
            return;
        }
    }
    echo("Congratulations, $userName!" . PHP_EOL);
}
