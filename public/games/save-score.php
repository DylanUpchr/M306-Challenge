<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>,  Jules Bursik <jules.brsk@eduge.ch>
* @version 1.0.0
*/

require_once '../../main.php';
use App\{DB, Score, Challenge, Game, User};

$errors = [];

/**
 * Validate score.
 *
 * @return int|null
 */
function validateScore() {
    global $errors;

    $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT);

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

    $challengeId = filter_input(INPUT_POST, 'challengeId', FILTER_VALIDATE_INT);

    if (!$challengeId) {
        $errors[] = 'Missing parameter challengeId';
        return null;
    }

    $challenge = Challenge::find($challengeId);

    if (!$challenge) {
        $errors[] = 'Cannot find challenge from challengeId value';
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

    $gameId = filter_input(INPUT_POST, 'gameId', FILTER_VALIDATE_INT);

    if (!$gameId) {
        $errors[] = 'Missing parameter gameId';
        return null;
    }

    $game = Game::find($gameId);

    if (!$game) {
        $errors[] = 'Cannot find challenge from gameId value';
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

    $accessToken = filter_input(INPUT_POST, 'accessToken', FILTER_SANITIZE_STRING);

    if (!$accessToken) {
        $errors[] = 'Missing parameter accessToken';
        return null;
    }

    $user = User::findByAccessToken($accessToken);

    if (!$user) {
        $errors[] = 'Cannot find user from accessToken value';
        return null;
    }

    return $user;
}

// Validate parameters.
$score = validateScore();
$challenge = validateChallenge();
$game = validateGame();
$user = validateUser();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

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
