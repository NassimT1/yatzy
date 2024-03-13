<?php
require_once '../app/models/Yatzy.php';
require_once '../app/models/GameState.php';

$yatzy = new Yatzy();
$gameStateModel = new GameState();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $data = $_POST['data'] ?? null;

    switch ($action) {
        case 'rollAllDice':
            $yatzy->rollAllDice();
            echo $yatzy->toJson();
            break;
        case 'toggleKeep':
            $index = $data['index'] ?? null;
            if ($index !== null) {
                $yatzy->toggleKeep($index);
                echo $yatzy->toJson();
            }
            break;
        case 'gameEnd':
            $isGameEnd = $yatzy->gameEnd();
            echo json_encode(['gameEnd' => $isGameEnd]);
            break;
        case 'saveGameState':
            $gameState = json_decode($data, true);
            $gameStateModel->save($gameState);
            echo json_encode(['success' => true]);
            break;
        case 'loadGameState':
            $gameState = $gameStateModel->load();
            echo json_encode(['gameState' => $gameState]);
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
