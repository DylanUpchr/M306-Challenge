<?php
require_once '../../../../main.php';
use App\User;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT);
$firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
$accessToken = sha1(uniqid());
$erreur = "";

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
<<<<<<< HEAD
else{
    $erreur = "Manque de param�tres.";
    echo json_encode(["error" => utf8_encode($erreur)], JSON_UNESCAPED_UNICODE);
=======

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
>>>>>>> d4a400978947706826ee81159c793a32b2dc9683
}

