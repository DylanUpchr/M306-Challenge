<?php
/**
 * @author Dylan Upchurch <dylan.upchr@eduge.ch>, Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>, Jules Bursik <jules.brsk@eduge.ch>
 * @version 1.0.0
 */

require_once '../../../../main.php';
use App\DB;
use App\User;

define('PARAM_CHALLENGE_ID', 'challenge_id');
define('PARAM_ACCESS_TOKEN', 'access_token');

//Params
$access_token = filter_input(INPUT_POST, PARAM_ACCESS_TOKEN, FILTER_SANITIZE_STRING);
$challengeId = filter_input(INPUT_POST, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');
//Check access_token and challengeId
$userId = User::findByAccessToken($access_token);
if ($userId and $challengeId) {
    try {
        //Insert link between challenge and user
        DB::run('INSERT INTO challenge_user (challenge_id, user_id, admin) VALUES (?, ?, ?)', $challengeId, $userId->id, 0);
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
}
else if ($userId === NULL) {
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_ACCESS_TOKEN . ' is invalid'
        ]
    ]);
}
else{
    //Catch param error
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_CHALLENGE_ID . ' and ' . PARAM_ACCESS_TOKEN . ' are required'
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
