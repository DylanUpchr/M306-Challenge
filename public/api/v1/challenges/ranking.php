<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Jules Stahli <jules.sthl@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';

use App\DB;
use App\User;
use App\Challenge;

/**
 * Validate user.
 *
 * @return User|null
 */
function validateUser() {
    global $errors;

    $accessToken = filter_input(INPUT_GET, 'access_token', FILTER_SANITIZE_STRING);

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

/**
 * Validate challenge.
 *
 * @return Challenge|null
 */
function validateChallenge() {
    global $errors;

    $challengeId = filter_input(INPUT_GET, 'challenge_id', FILTER_VALIDATE_INT);

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

$user = validateUser();
$challenge = validateChallenge();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    $ranking = $challenge->ranking($challenge->id);

    echo json_encode([
        'successes' => [
            'Ranking got',
        ],
        'ranking' => $ranking,
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}