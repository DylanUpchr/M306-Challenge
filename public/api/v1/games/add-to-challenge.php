<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>, Jules Stahli <jules.sthl@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';
use App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_GAME_ID', 'gameId');

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
$gameId = filter_input(INPUT_POST, PARAM_GAME_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_POST, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

header('Access-Control-Allow-Origin: *');
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
            PARAM_CHALLENGE_ID.' is required'
        ]
    ]);
}

function Reply($response){
    echo json_encode($response);
    exit;
}
