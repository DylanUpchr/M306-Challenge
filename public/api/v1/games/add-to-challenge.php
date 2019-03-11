<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>, Jules Stahli <jules.sthl@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';
use App\DB;

$errors = [];

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

$user = validateUser();
$game = validateGame();
$challenge = validateChallenge();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    DB::run('INSERT INTO challenge_game(challenge_id, game_id) VALUES (?, ?)', $challenge->id, $game->id);

    echo json_encode([
        'successes' => [
            'Game added to challenge',
        ],
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}
