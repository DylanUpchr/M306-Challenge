<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>, Jules Stahli <jules.sthl@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';
use App\DB;
use App\User;

$idChallenge = filter_input(INPUT_POST, 'challenge_id', FILTER_VALIDATE_INT);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

$user = User::findByAccessToken($token);
if ($idChallenge && $user) {
    // récupère le challenge demande
    $response = DB::run('SELECT * FROM chalenges WHERE `id`=?', $idChallenge);
    // ajoute au challenge les jeux du challenege dans la propriété games
    $response['games'] = DB::run('SELECT games.id AS id, games.name AS name FROM challenge_game INNER JOIN games ON challenge_game.game_id = games.id WHERE challenge_game=?', $idChallenge);
    // pour chaque jeux récpère les scores des joueurs par ordre décroissant du score et l'ajoute à la propirété ranking du jeux
    foreach ($response['games'] as $game) {
        $game['ranking'] = DB::run('SELECT scores.user_id AS user_id, users.first_name AS user_first_name, users.last_name AS user_last_name, scores.score AS score FROM scores INNER JOIN users ON scores.user_id = users.id WHERE scores.challenge_id=? AND scores.game_id=? ORDER BY scores.score DESC', $idChallenge, $game['id']);
    }
    // retourne la structure de données générée
    /*
    {
        ...,
        games : [
            ...,
            {
                ...,
                ranking : [
                    ...
                ]
            }
        ]
    }
    */
    echo json_encode($response);
}else if($user === null){
    echo json_encode(['status' => 'error', 'error' => 'Invalid token']);
}else{
    echo json_encode(['status' => 'error', 'error' => 'Missing id or token']);
}