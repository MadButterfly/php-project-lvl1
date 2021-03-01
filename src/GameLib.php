<?php

namespace Brain\Games\GameLib;

use function cli\prompt;

function brainEven(string $userName)
{
    game($userName, 'brain-even');
}

function brainCalc(string $userName)
{
    game($userName, 'brain-calc');
}

function game(string $userName, string $game)
{
    $tries = 3;
    $correctAnswers = 0;

    $rules = gameRules($game);
    echo($rules . PHP_EOL);

    while ($correctAnswers < $tries) {
        $expectedAnswer = gameRound($game);
        $actualAnswer = prompt('Your answer');
        $isCorrect = strval($expectedAnswer) === strtolower($actualAnswer);
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

function gameRules($game)
{
    switch ($game) {
        case 'brain-even':
            return 'Answer "yes" if the number is even, otherwise answer "no"';

        case 'brain-calc':
            return 'What is the result of the expression?';

        default:
            return '';
    }
}

function gameRound($game)
{
    switch ($game) {
        case 'brain-even':
            return roundBrainEven();

        case 'brain-calc':
            return roundBrainCalc();

        default:
            return;
    }
}

function roundBrainEven()
{
    $number = rand(0, 999);
    echo("Question: $number" . PHP_EOL);
    return isEven($number) ? 'yes' : 'no';
}

function isEven(int $num)
{
    return $num % 2 == 0;
}

function roundBrainCalc()
{
    $firstNum = rand(0, 99);
    $secondNum = rand(0, 99);
    $operations = ['+', '-', '*'];
    $operationKey = array_rand($operations);
    $operation = $operations[$operationKey];
    echo("Question: $firstNum $operation $secondNum" . PHP_EOL);
    switch ($operation) {
        case '+':
            return $firstNum + $secondNum;

        case '-':
            return $firstNum - $secondNum;

        case '*':
            return $firstNum * $secondNum;
    }
}
