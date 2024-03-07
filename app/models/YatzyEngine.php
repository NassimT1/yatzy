<?php

function countDice($diceValues) {
    $counts = [];
    foreach ($diceValues as $value) {
        if (!isset($counts[$value])) {
            $counts[$value] = 0;
        }
        $counts[$value]++;
    }
    return $counts;
}

function scoreOfAKind($diceValues, $kind) {
    $counts = countDice($diceValues);
    foreach ($counts as $num => $count) {
        if ($count >= $kind) {
            return array_sum($diceValues);
        }
    }
    return 0;
}

function scoreFullHouse($diceValues) {
    $counts = countDice($diceValues);
    $hasThree = false;
    $hasTwo = false;
    foreach ($counts as $count) {
        if ($count === 3) $hasThree = true;
        if ($count === 2) $hasTwo = true;
    }
    return $hasThree && $hasTwo ? 25 : 0;
}

function scoreSmallStraight($diceValues) {
    $uniqueValues = array_unique($diceValues);
    sort($uniqueValues);
    $straights = [
        [1, 2, 3, 4],
        [2, 3, 4, 5],
        [3, 4, 5, 6]
    ];
    foreach ($straights as $straight) {
        if (!array_diff($straight, $uniqueValues)) {
            return 30;
        }
    }
    return 0;
}

function scoreLargeStraight($diceValues) {
    $uniqueValues = array_unique($diceValues);
    sort($uniqueValues);
    $uniqueString = implode('', $uniqueValues);
    return $uniqueString === '12345' || $uniqueString === '23456' ? 40 : 0;
}

function scoreChance($diceValues) {
    return array_sum($diceValues);
}

function scoreYatzy($diceValues) {
    return count(array_unique($diceValues)) === 1 ? 50 : 0;
}

function scoreUpperSection($diceValues, $number) {
    return count(array_filter($diceValues, function($value) use ($number) { return $value === $number; })) * $number;
}

