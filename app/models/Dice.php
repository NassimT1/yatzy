<?php

namespace App\Models;

class Dice {
    public $min;
    public $max;

    public function __construct($min = 1, $max = 6) {
        $this->min = $min;
        $this->max = $max;
    }

    // Simulates rolling the dice
    public function roll() {
        return rand($this->min, $this->max);
    }
}
