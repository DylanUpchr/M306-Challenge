<?php
require_once '../../../../main.php';
use App\{DB, Score, Challenge, Game, User};

$errors = [];

/**
 * Validate score.
 *
 * @return int|null
 */
function validateScore() {
    global $errors;

    $score = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_STRING);

    if (!$score) {
        $errors[] = 'Missing parameter score';
        return null;
    }

    return $score;
}

/**
 * Validate challenge.
 *
 * @return Challenge|null
 */
function validateChallenge() {
    global $errors;

    $challengeId = filter_input(INPUT_POST, 'challenge_id', FILTER_SANITIZE_STRING);

    if (!$challengeId) {
        $errors[] = 'Missing parameter challenge_id';
        return null;
    } 
    
    $challenge = Challenge::find($challengeId);
    
    if (!$challenge) {
        $errors[] = 'Cannot find challenge from challenge_id value';
        return null;
    }    

    return $challenge;
}

/**
 * Validate game.
 *
 * @return Game|null
 */
function validateGame() {
    global $errors;

    $gameId = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_STRING);
    
    if (!$gameId) {
        $errors[] = 'Missing parameter game_id';
        return null;
    } 

    $game = Game::find($gameId);

    if (!$game) {
        $errors[] = 'Cannot find challenge from game_id value'; 
        return null;
    }

    return $game;
}

/**
 * Validate user.
 *
 * @return User|null
 */
function validateUser() {
    global $errors;

    $accessToken = filter_input(INPUT_POST, 'access_token', FILTER_SANITIZE_STRING);

    if (!$accessToken) {
        $errors[] = 'Missing parameter access_token';
        return null;
    } 

    $user = User::findByAccessToken($accessToken);
    
    if (!$user) {
        $errors[] = 'Cannot find user from access_token value';
        return null;
    }

    return $user;
}

$score = validateScore();
$challenge = validateChallenge();
$game = validateUser();
$user = validateUser();

header('Content-Type: application/json;charset=utf-8');

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
