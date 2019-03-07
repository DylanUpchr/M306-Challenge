<?php
/**
 * @author Dylan Upchurch <dylan.upchr@eduge.ch>, Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>, Jules Bursik <jules.brsk@eduge.ch>
 * @version 1.0.0
 */

require_once '../../../../main.php';
use App\DB;

define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_USER_ID', 'userId');
define('PARAM_ADMIN_ID', 'adminId');

//Params
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
$userId = filter_input(INPUT_POST, PARAM_USER_ID, FILTER_VALIDATE_INT);
$adminId = filter_input(INPUT_POST, PARAM_ADMIN_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_POST, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');
//Check token, userId and challengeId
if (!empty($token) and $userId and $adminId and $challengeId) {
    try {
        //Insert link between challenge and user
        DB::run('INSERT INTO challenge_user (challenge_id, user_id, admin) VALUES (?, ?, ?)', $challengeId, $userId, $adminId);
    } catch (\Throwable $th) {
        //Catch DB error
    Reply([
        'status' => 'error',
        'errors' => [
            'Database error occured.'
        ]
    ]);
    }
    //Success
    Reply([
        'status' => 'success'
    ]);
}else{
    //Catch param error
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_CHALLENGE_ID . ', ' . PARAM_ADMIN_ID . ' and ' . PARAM_USER_ID . ' are required'
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