<?php
/**
 * @author Dylan Upchurch <dylan.upchr@eduge.ch>
 * @version 1.0.0
 */
require_once '../../../../main.php';
use App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_USER_ID', 'userId');
define('PARAM_ADMIN_ID', 'adminId');

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
$userId = filter_input(INPUT_POST, PARAM_USER_ID, FILTER_VALIDATE_INT);
$adminId = filter_input(INPUT_POST, PARAM_ADMIN_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_POST, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

header('Content-Type: application/json;charset=utf-8');
//Check token, userId and challengeId
if (!empty($token) and $userId and $adminId and $challengeId) {
    try {
        //code...
        DB::run('INSERT INTO challenge_user (challenge_id, user_id, admin) VALUES (?, ?, ?)', $challengeId, $userId, $adminId);
    } catch (\Throwable $th) {
    Reply([
        'status' => 'error',
        'errors' => [
            $th
        ]
    ]);
    }
    Reply([
        'status' => 'success'
    ]);
}else{
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_CHALLENGE_ID . ' and ' . PARAM_USER_ID . ' are required'
        ]
    ]);
}
/**
 * Reply
 * Retourne la reponse de la condition plus haut
 * @param [string array] $response
 * @return void
 */
function Reply($response){
    echo json_encode($response);
    exit;
}