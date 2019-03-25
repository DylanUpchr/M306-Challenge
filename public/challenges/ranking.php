<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Jules Stahli <jules.sthl@eduge.ch>, Jules Bursik <jules.brsk@eduge.ch>
* @version 1.0.0
*/
require_once '../../main.php';

use App\DB;
use App\User;
use App\Challenge;

$errors = [];

/**
 * Validate user.
 *
 * @return User|null
 */
function validateUser() {
    global $errors;

    $accessToken = filter_input(INPUT_GET, 'accessToken', FILTER_SANITIZE_STRING);

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
 * Validate challenge.
 *
 * @return Challenge|null
 */
function validateChallenge() {
    global $errors;

    $challengeId = filter_input(INPUT_GET, 'challengeId', FILTER_VALIDATE_INT);

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
$challenge = validateChallenge();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    $ranking = $challenge->ranking($challenge->id);

    echo json_encode([
        'successes' => [
            'Ranking received',
        ],
        'ranking' => $ranking,
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}