<?php
class Yatzy {

    // --------------------------Code from yatzy.js--------------------------
    public $dotPositionMatrix = [
        1 => [[45, 50]],
        2 => [[20, 20], [80, 80]],
        3 => [[20, 20], [50, 50], [80, 80]],
        4 => [[20, 20], [20, 80], [80, 20], [80, 80]],
        5 => [[20, 20], [20, 80], [50, 50], [80, 20], [80, 80]],
        6 => [[20, 20], [20, 80], [50, 20], [50, 80], [80, 20], [80, 80]],
    ];

    function rollDice() {
        return rand(1, 6); 
    }

    // --------------------------Code from yatzy_game.js--------------------------
    public $gameState = [
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
                    $gameState["diceValues"][$index] = $this->rollDice();
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

    // --------------------------Code from yatzy_engine.js--------------------------
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
        $counts = $this->countDice($diceValues);
        foreach ($counts as $num => $count) {
            if ($count >= $kind) {
                return array_sum($diceValues);
            }
        }
        return 0;
    }
    
    function scoreFullHouse($diceValues) {
        $counts = $this->countDice($diceValues);
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

    // --------------------------JSON stuff--------------------------
    public function toJson() {
        // Convert the object's properties to an associative array
        $data = ['gameState' => $this->gameState];
    
        // Convert the associative array to a JSON string
        return json_encode($data);
    }

    public function toEncodedJson(){
        return json_encode();
    }
}
