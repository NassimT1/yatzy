<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatzy</title>
    <link rel="stylesheet" href="styles.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/dice.js"></script>
    <script src="assets/yatzy_game.js"></script>
    <script src="assets/yatzy_engine.js"></script>
</head>
<body>
    <div class="howToPlay">
        <p>How to play: Roll the dice (max: 3 rolls). Select a score by clicking on the value. </p>
    </div> <hr>
    <div class="dice-container" id="dice-container"></div>
    <button type="button" class="roll-button" id="roll-dice">Roll Dice</button>
    <button type="button" class="startOverButton-main" id="startOverButton">Start Over</button>

    <div class="score-sheet">
        <div class="grid top-scores">
            <div>Ones</div><div>Twos</div><div>Threes</div><div>Fours</div>
            <div>Fives</div><div>Sixes</div><div>Sum</div><div>Bonus</div><div>Total Top</div>
            <div id="ones-value" class="clickable">0</div>
            <div id="twos-value" class="clickable">0</div>
            <div id="threes-value" class="clickable">0</div>
            <div id="fours-value" class="clickable">0</div>
            <div id="fives-value" class="clickable">0</div>
            <div id="sixes-value" class="clickable">0</div>
            <div id="sum-value" class="non-clickable">0</div>
            <div id="bonus-value" class="non-clickable">0</div>
            <div id="total-top-value" class="non-clickable">0</div>
        </div>
        <div class="grid bottom-scores">
            <div>3 of a kind</div><div>4 of a kind</div><div>Full House</div>
            <div>Small Straight</div><div>Large Straight</div><div>Chance</div>
            <div>Yatzy</div><div>Total Bottom</div><div>Final Total</div>
            <div id="three-kind-value" class="clickable">0</div>
            <div id="four-kind-value" class="clickable">0</div>
            <div id="full-house-value" class="clickable">0</div>
            <div id="small-straight-value" class="clickable">0</div>
            <div id="large-straight-value" class="clickable">0</div>
            <div id="chance-value" class="clickable">0</div>
            <div id="yatzy-value" class="clickable">0</div>
            <div id="total-bottom-value" class="non-clickable">0</div>
            <div id="final-total-value" class="non-clickable">0</div>
        </div>
    </div>
    
    <div class="footer">
        <a href="https://NassimT1.github.io/csi3540_labs/lab05/assets/design_system/dice.html">Documentation</a>
    </div>
    <div id="gameOverModal" class="modal">
        <div class="modal-content">
          <span class="close-button">&times;</span>
          <p id="gameOverMessage"></p>
          <!-- Start Over Button -->
          <button id="finalStartOverButton" class="gameOver">Start Over</button>
        </div>
    </div>

    <div id="leaderboard">
        <h2>Leaderboard</h2>
        <div id="leaderboard-content"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to send a request to the API
            function sendRequest(action, data, callback) {
                $.ajax({
                    url: 'api.php',
                    type: 'POST',
                    data: {
                        action: action,
                        data: data
                    },
                    success: function(response) {
                        callback(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            // Function to load the leaderboard
            function loadLeaderboard() {
                $.ajax({
                    url: 'leaderboard.php',
                    type: 'GET',
                    success: function(data) {
                        $('#leaderboard-content').html(data);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            // Call the loadLeaderboard function when the page loads
            loadLeaderboard();

            // Example: Save the game state when the game ends
            function gameEnd() {
                // Your game end logic here
                sendRequest('saveGameState', gameState, function(response) {
                    console.log('Game state saved successfully');
                });
            }

            // Example: Load the game state when the game starts
            $(document).ready(function() {
                sendRequest('loadGameState', null, function(response) {
                    if (response.gameState) {
                        gameState = response.gameState;
                        updateGameDisplay();
                        console.log('Game state loaded successfully');
                    }
                });
            });
        });
    </script>
</body>
</html>
