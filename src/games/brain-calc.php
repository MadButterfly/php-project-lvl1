<?php

namespace Brain\Games\Games;

use function Brain\Games\Engine\game;

const RULES = 'What is the result of the expression?';
const OPERATIONS = ['+', '-', '*'];
const MIN_VALUE = 0;
const MAX_VALUE = 99;

function brainCalc(): void
{
    game(
        function () {
            $firstNum = rand(MIN_VALUE, MAX_VALUE);
            $secondNum = rand(MIN_VALUE, MAX_VALUE);
            $operationKey = array_rand(OPERATIONS);
            $operation = OPERATIONS[$operationKey];
            echo("Question: $firstNum $operation $secondNum" . PHP_EOL);
            return getOperationResult($firstNum, $secondNum, $operation);
        },
        RULES
    );
}

function getOperationResult(int $firstNum, int $secondNum, string $operation): int
{
    switch ($operation) {
        case '+':
            return $firstNum + $secondNum;

        case '-':
            return $firstNum - $secondNum;

        case '*':
            return $firstNum * $secondNum;
    }
}
