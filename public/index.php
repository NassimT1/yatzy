<?php

require_once('_config.php');

use App\Models\Dice;

$d = new Dice();

for ($i = 1; $i <= 5; $i++) {
    echo "ROLL {$i}: {$d->roll()}<br>";
}
