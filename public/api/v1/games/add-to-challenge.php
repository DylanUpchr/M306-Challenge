<?php
require_once '../../../../main.php';
use App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_GAME_ID', 'gameId');

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
$gameId = filter_input(INPUT_GET, PARAM_GAME_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_GET, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

header('Content-Type: application/json;charset=utf-8');

if (!empty($token) && $gameId and $challengeId) {
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
