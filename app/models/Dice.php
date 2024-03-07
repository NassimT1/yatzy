<?php

$dotPositionMatrix = [
    1 => [[45, 50]],
    2 => [[20, 20], [80, 80]],
    3 => [[20, 20], [50, 50], [80, 80]],
    4 => [[20, 20], [20, 80], [80, 20], [80, 80]],
    5 => [[20, 20], [20, 80], [50, 50], [80, 20], [80, 80]],
    6 => [[20, 20], [20, 80], [50, 20], [50, 80], [80, 20], [80, 80]],
];

function rollDice() {
    return rand(1, 6); // Use PHP's rand() function
}

?>
