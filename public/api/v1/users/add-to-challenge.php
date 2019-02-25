<?php
require_once(__DIR__.'/../../../../main.php');
USE App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_USER_ID', 'userId');

$userId = filter_input(INPUT_GET, PARAM_USER_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_GET, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

if ($userId and $challengeId) {
    DB::run('INSERT INTO challenge_user (challenge_id, user_id) VALUES ('.$challengeId.', '.$userId.')');
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