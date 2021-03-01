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

function brainGcd(string $userName)
{
    game($userName, 'brain-gcd');
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

        case 'brain-gcd':
            return 'Find the greatest common divisor of given numbers.';
            
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
            
        case 'brain-gcd':
            return roundBrainGcd();

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

function roundBrainGcd()
{
    $firstNum = rand(1, 99);
    $secondNum = rand(1, 99);
    echo("Question: $firstNum $secondNum" . PHP_EOL);
    // if numbers are equal - return first one
    if ($firstNum === $secondNum) {
        return $firstNum;
    }
    // otherwise start checking from half of minimal value rounded up + 1
    $min = $firstNum < $secondNum ? $firstNum : $secondNum;
    $assumption = ceil($min/2) + 1;
    for ($i = $assumption; $i > 0; $i--) {
        if ($firstNum % $i == 0 && $secondNum % $i == 0) {
            return $i;
        }
    }
}