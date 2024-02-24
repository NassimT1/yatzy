<?php

namespace App\Models;

class YatzyEngine {
    // Calculate score for a specific turn based on dice values and score box selection
    public function calculateScore(array $diceValues, $scoreBox) {
        switch ($scoreBox) {
            case 'ones':
            case 'twos':
            case 'threes':
            case 'fours':
            case 'fives':
            case 'sixes':
                return $this->calculateUpperSectionScore($diceValues, $scoreBox);
            case 'threeOfAKind':
                return $this->calculateOfAKind($diceValues, 3);
            case 'fourOfAKind':
                return $this->calculateOfAKind($diceValues, 4);
            case 'fullHouse':
                return $this->calculateFullHouse($diceValues);
            case 'smallStraight':
                return $this->calculateSmallStraight($diceValues);
            case 'largeStraight':
                return $this->calculateLargeStraight($diceValues);
            case 'chance':
                return array_sum($diceValues);
            case 'yatzy':
                return $this->calculateYatzy($diceValues);
            default:
                return 0;
        }
    }

    // Calculate scores for the upper section (ones through sixes)
    private function calculateUpperSectionScore($diceValues, $scoreBox) {
        $number = substr($scoreBox, 0, 1); // Extract the first character to get the number (e.g., "ones" -> 1)
        return array_sum(array_filter($diceValues, function ($die) use ($number) {
            return $die == $number;
        })) * $number;
    }

    // Calculate score for three/four of a kind
    private function calculateOfAKind($diceValues, $count) {
        $valuesCount = array_count_values($diceValues);
        foreach ($valuesCount as $value => $qty) {
            if ($qty >= $count) {
                return array_sum($diceValues);
            }
        }
        return 0;
    }

    // Calculate score for full house
    private function calculateFullHouse($diceValues) {
        $valuesCount = array_count_values($diceValues);
        if (in_array(3, $valuesCount) && in_array(2, $valuesCount)) {
            return 25;
        }
        return 0;
    }

    // Calculate score for small straight
    private function calculateSmallStraight($diceValues) {
        $uniqueValues = array_unique($diceValues);
        sort($uniqueValues);
        $straights = [
            [1, 2, 3, 4],
            [2, 3, 4, 5],
            [3, 4, 5, 6],
        ];
        foreach ($straights as $straight) {
            if (array_intersect($straight, $uniqueValues) == $straight) {
                return 30;
            }
        }
        return 0;
    }

    // Calculate score for large straight
    private function calculateLargeStraight($diceValues) {
        sort($diceValues);
        $largeStraights = [
            [1, 2, 3, 4, 5],
            [2, 3, 4, 5, 6],
        ];
        foreach ($largeStraights as $straight) {
            if ($diceValues === $straight) {
                return 40;
            }
        }
        return 0;
    }

    // Calculate score for Yatzy
    private function calculateYatzy($diceValues) {
        if (count(array_unique($diceValues)) == 1) {
            return 50;
        }
        return 0;
    }
}
