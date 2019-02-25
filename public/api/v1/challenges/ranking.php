<?php
require_once(__DIR__.'/../../../../main.php');
USE App\DB;

$idChallenge = filter_input(INPUT_GET, 'challenge_id', FILTER_VALIDATE_INT);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

header('Content-Type: application/json;charset=utf-8');

if ($idChallenge && !empty($token)) {
    $response = DB::run('SELECT * FROM chalenges WHERE `id`=?', $idChallenge);
    $games = DB::run('SELECT games.id AS id, games.name AS name FROM challenge_game INNER JOIN games ON challenge_game.game_id = games.id WHERE challenge_game=?', $idChallenge);
    $response['games'] = $games;
    foreach ($response['games'] as $game) {
        $game['ranking'] = DB::run('SELECT scores.user_id AS user_id, users.first_name AS user_first_name, users.last_name AS user_last_name, scores.score AS score FROM scores INNER JOIN users ON scores.user_id = users.id WHERE scores.challenge_id=? AND scores.game_id=? ORDER BY scores.score DESC', $idChallenge, $game['id']);
    }
    echo json_encode($response);
}else{
    echo json_encode(['error' => 'missing id or token']);
}