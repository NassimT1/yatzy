<?php

include 'Dice.php';

$gameState = [
    "rollCount" => 0,
    "diceValues" => [1, 1, 1, 1, 1], 
    "keep" => [false, false, false, false, false],
    "currentRound" => 0,
    "selectedScores" => [],
    "roundStarted" => false
];

function rollAllDice(&$gameState) {
    if ($gameState["rollCount"] < 3) {
        foreach ($gameState["diceValues"] as $index => $value) {
            if (!$gameState["keep"][$index]) {
                $gameState["diceValues"][$index] = rollDice();
            }
        }
        $gameState["rollCount"]++;
        $gameState["roundStarted"] = true;
    }
    
    if ($gameState["rollCount"] === 3) {
    }
}

function toggleKeep(&$gameState, $index) {
    if ($gameState["rollCount"] > 0) {
        $gameState["keep"][$index] = !$gameState["keep"][$index];
    }
}

function gameEnd($gameState) {
    return $gameState["currentRound"] === 13;
}
