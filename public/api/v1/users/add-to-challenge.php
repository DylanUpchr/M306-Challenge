<?php
require_once '../../../../main.php';
use App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_USER_ID', 'userId');

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
$userId = filter_input(INPUT_POST, PARAM_USER_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_POST, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

header('Content-Type: application/json;charset=utf-8');

if (!empty($token) and $userId and $challengeId) {
    DB::run('INSERT INTO challenge_user (challenge_id, user_id) VALUES ('.$challengeId.', '.$userId.')');
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