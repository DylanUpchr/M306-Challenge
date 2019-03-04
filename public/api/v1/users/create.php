<?php
require_once '../../../../main.php';
use App\User;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT);
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

header('Content-Type: application/json;charset=utf-8');

if (empty($errors)) {
    $user = User::create($username, $password, $firstName, $lastName);

    echo json_encode([
        'successes' => [
            'User successfully registered'
        ],
        'access_token' => $user->accessToken,
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}

