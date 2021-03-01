<?php

namespace Brain\Games\GameLib;

use function Brain\Games\Cli\greetings;
use function cli\prompt;

function brainEven()
{
    game('brain-even');
}

function brainCalc()
{
    game('brain-calc');
}

function brainGcd()
{
    game('brain-gcd');
}

function brainProgression()
{
    game('brain-progression');
}


function game(string $game)
{
    $tries = 3;
    $correctAnswers = 0;

    $userName = greetings();
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
            
        case 'brain-progression':
            return 'What number is missing in the progression?';
            
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
            
        case 'brain-progression':
            return roundBrainProgression();
            
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

function roundBrainProgression()
{
    $length = 10;
    $step = rand(2, 5);
    $element = rand(0, 99);
    $progression = [$element];
    
    for ($i = 0, $elementsToAdd = $length - 1; $i < $elementsToAdd; $i++) {
        $element += $step;
        $progression[] = $element;
    }
    
    $hiddenElement = array_rand($progression);
    $answer = $progression[$hiddenElement];
    $progression[$hiddenElement] = '..';
    $question = implode(' ', $progression);
    echo("Question: $question" . PHP_EOL);
    return $answer;
}