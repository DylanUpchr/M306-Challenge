<?php
require_once(__DIR__.'/../../../../main.php');
USE App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_GAME_ID', 'gameId');

$gameId = filter_input(INPUT_GET, PARAM_GAME_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_GET, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

if ($gameId and $challengeId) {
    DB::run('INSERT INTO challenge_game (challenge_id, game_id) VALUES ('.$challengeId.', '.$gameId.')');
    Reply([
        'status' => 'success'
    ]);
}else{
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_CHALLENGE_NAME.' is required'
        ]
    ]);
}

function Reply($response){
    echo json_encode($response);
    exit;
}
