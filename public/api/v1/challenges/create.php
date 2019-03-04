<?php
require_once '../../../../main.php';
use App\DB;

// Nom du paramètre d'entrée en get
define('PARAM_CHALLENGE_NAME', 'name');
define('DUREE_CHALLENGE', 1000000); //timestamp actuellement 1jour

// Filtrage des paramètre get
$challengeName = filter_input(INPUT_GET, PARAM_CHALLENGE_NAME, FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

header('Content-Type: application/json;charset=utf-8');

if (!empty($token) && !empty($challengeName)) {
    // Insertion d'un nouveau challenge dans la base
    DB::run('INSERT INTO challenges (name, start_date, end_date) VALUES ("'.$challengeName.'", NOW(), NOW() + '.DUREE_CHALLENGE.')');
    Reply([
        'status' => 'success'
    ]);
}else{
    // Répondre une erreur
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_CHALLENGE_NAME.' is required'
        ]
    ]);
}

// functions

// Répondre en json
function Reply($response){
    echo json_encode($response);
    exit;
}
