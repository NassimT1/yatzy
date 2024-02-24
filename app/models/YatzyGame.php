<?php

namespace App\Models;

class YatzyGame {
    public $currentRoll;
    public $diceValues;
    public $keepState;

    public function __construct() {
        $this->currentRoll = 0; // Which roll you are on: 0, 1, 2, or 3
        $this->diceValues = array_fill(0, 5, null); // Current values of the 5 dice
        $this->keepState = array_fill(0, 5, false); // Keep/re-roll state for each die
    }

    public function rollDice() {
        for ($i = 0; $i < 5; $i++) {
            if (!$this->keepState[$i] || $this->currentRoll == 0) {
                $this->diceValues[$i] = rand(1, 6); // Roll each die that is not kept
            }
        }
        $this->currentRoll++;
    }

    public function selectDie($index) {
        $this->keepState[$index] = !$this->keepState[$index]; // Toggle keep state
    }

    public function resetRound() {
        $this->currentRoll = 0;
        $this->keepState = array_fill(0, 5, false); // Reset keep states for new round
    }
}
