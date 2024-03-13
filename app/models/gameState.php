<?php
class GameState {
    public function save($gameState) {
        $_SESSION['gameState'] = $gameState;
    }

    public function load() {
        return $_SESSION['gameState'] ?? null;
    }

    public function getTopScores() {
        // For simplicity, we'll assume the game state includes the final score.
        // In a real application, you'd likely have a more complex structure.
        $scores = isset($_SESSION['scores']) ? $_SESSION['scores'] : [];
        usort($scores, function($a, $b) {
            return $b['final-total-value'] - $a['final-total-value'];
        });
        return array_slice($scores, 0, 10);
    }
}
