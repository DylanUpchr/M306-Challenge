<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>,  Jules Bursik <jules.brsk@eduge.ch>
* @version 1.0.0
*/

require_once '../../../../main.php';
use App\User;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password');
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);

$errors = [];

if (!$username) {
    $errors[] = 'Missing parameter username';
} else {
    if (User::findByUsername($username)) {
        $errors[] = 'Username already taken';
    }
}

if (!$password) {
    $errors[] = 'Missing parameter password';
}

if (!$firstName) {
    $errors[] = 'Missing parameter first_name';
}

if (!$lastName) {
    $errors[] = 'Missing parameter last_name';
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    $user = User::create($username, $password, $firstName, $lastName);

    echo json_encode([
        'successes' => [
            'User successfully registered'
        ],
        'access_token' => $user->accessToken,
        'username' => $user->username,
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}

