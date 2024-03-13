<?php
require_once '../app/models/GameState.php';

$gameStateModel = new GameState();
$scores = $gameStateModel->getTopScores();

echo "<table>";
echo "<tr><th>Rank</th><th>Score</th></tr>";
foreach ($scores as $index => $score) {
    echo "<tr><td>" . ($index + 1) . "</td><td>" . $score['final-total-value'] . "</td></tr>";
}
echo "</table>";
