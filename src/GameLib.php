<?php

namespace Brain\Games\GameLib;

use function cli\prompt;

function brainEven(string $userName)
{
    $tries = 3;
    $correctAnswers = 0;
    echo('Answer "yes" if the number is even, otherwise answer "no"' . PHP_EOL);

    while ($correctAnswers < $tries) {
        $number = rand(0, 999);
        echo("Question: $number" . PHP_EOL);
        $actualAnswer = prompt('Your answer');
        $expectedAnswer = isEven($number) ? 'yes' : 'no';
        $isCorrect = $expectedAnswer === strtolower($actualAnswer);
        if ($isCorrect) {
            echo("Correct!" . PHP_EOL);
            $correctAnswers += 1;
        } else {
            echo(
                "'$actualAnswer' is wrong answer ;(. Correct answer was '$expectedAnswer'."
                . PHP_EOL . "Let's try again, $userName!" . PHP_EOL
            );
            return;
        }
    }
    echo("Congratulations, $userName!" . PHP_EOL);
}

function isEven(int $num)
{
    return $num % 2 == 0;
}
