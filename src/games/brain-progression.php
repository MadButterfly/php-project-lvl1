<?php

namespace Brain\Games\Games;

use function Brain\Games\Engine\game;

const RULES = 'What number is missing in the progression?';
const LENGTH = 10;
const MIN_STEP = 2;
const MAX_STEP = 5;
const MAX_START_ELEMENT = 99;

function brainProgression(): int
{
    game(
        function () {
            $progression = buildProgression();
            $hiddenElementIndex = array_rand($progression);
            hideElement($progression, $hiddenElementIndex);
            return $progression[$hiddenElementIndex];
        },
        RULES
    );
}

function buildProgression(): array
{
    $step = rand(MIN_STEP, MAX_STEP);
    $element = rand(0, MAX_START_ELEMENT);
    $progression = [$element];

    for ($i = 0, $elementsToAdd = LENGTH - 1; $i < $elementsToAdd; $i++) {
        $element += $step;
        $progression[] = $element;
    }
    return $progression;
}

function hideElement(array $progression, int $index): void
{
    $progression[$index] = '..';
    $question = implode(' ', $progression);
    echo("Question: $question" . PHP_EOL);
}
