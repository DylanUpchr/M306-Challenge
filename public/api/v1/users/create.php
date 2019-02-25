<?php
require_once "../../../../main.php";

use App\User;

$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_GET, 'password');
$firstName = filter_input(INPUT_GET, 'first_name', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_GET, 'last_name', FILTER_SANITIZE_STRING);

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
    User::create($username, $password, $firstName, $lastName);

    echo json_encode([
        'successes' => [
            'User successfully registered'
        ],
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}

