<?php
require_once "../../../../main.php";

use App\{DB, Score, Challenge, Game, User};

$score = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_STRING);
$challengeId = filter_input(INPUT_POST, 'challenge_id', FILTER_SANITIZE_STRING);
$gameId = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_STRING);
$accessToken = filter_input(INPUT_POST, 'access_token', FILTER_SANITIZE_STRING);

$errors = [];

if (!$score) {
    $errors[] = 'Missing parameter score';
}

if (!$challengeId) {
    $errors[] = 'Missing parameter challenge_id';
}

if (!$gameId) {
    $errors[] = 'Missing parameter game_id';
}

if (!$accessToken) {
    $errors[] = 'Missing parameter access_token';
}

header('Content-Type: application/json;charset=utf-8');

$challenge = Challenge::find($challengeId);

if (!$challenge) {
    $errors[] = 'Cannot find challenge from challenge_id value';
}

$game = Game::find($gameId);

if (!$game) {
    $errors[] = 'Cannot find challenge from game_id value';
}

$user = User::findByAccessToken($accessToken);

if (!$user) {
    $errors[] = 'Cannot find user from access_token value';
}

if (empty($errors)) {
    Score::create($score, $challenge, $game, $user);

    echo json_encode([
        'successes' => [
            'Score has been registred',
        ],
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}
