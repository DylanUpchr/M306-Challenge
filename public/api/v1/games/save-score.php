<?php
require_once "../../../../main.php";
use App\{DB, User};

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
$score = filter_input(INPUT_GET, 'score', FILTER_SANITIZE_STRING);
$challenge_id = filter_input(INPUT_GET, 'challenge_id', FILTER_SANITIZE_STRING);
$gameId = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_STRING);


//header('Content-Type: application/json;charset=utf-8');

var_dump(User::getIdUser($token));

if (!empty($token) && !empty($score) && !empty($challenge_id) && !empty($gameId)){
   
   
   
    echo json_encode("Score ajouté.");
}
else{
    $erreur = "Manque de paramètres.";
    echo json_encode(["error" =>$erreur], JSON_UNESCAPED_UNICODE);
}
