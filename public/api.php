<?php
// Include the Yatzy class file
require_once '../app/models/Yatzy.php';

// Initialize the Yatzy game
$yatzy = new Yatzy();

// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST requests
    $action = $_POST['action'] ?? null;
    $data = $_POST['data'] ?? null;

    switch ($action) {
        case 'rollAllDice':
            $yatzy->rollAllDice($yatzy->gameState);
            echo $yatzy->toJson();
            break;
        case 'toggleKeep':
            $index = $data['index'] ?? null;
            if ($index !== null) {
                $yatzy->toggleKeep($yatzy->gameState, $index);
                echo $yatzy->toJson();
            }
            break;
        case 'gameEnd':
            $isGameEnd = $yatzy->gameEnd($yatzy->gameState);
            echo json_encode(['gameEnd' => $isGameEnd]);
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    // Handle other request methods (GET, etc.) if needed
    echo json_encode(['error' => 'Invalid request method']);
}
