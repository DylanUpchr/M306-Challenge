<?php
require_once '../../../../main.php';
use App\{DB, User};

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password');
$errors = [];

if (!$username) {
    $errors[] = 'Missing parameter username';
}

if (!$password) {
    $errors[] = 'Missing parameter password';
}

if ($username && $password) {
    $user = User::findByUsername($username);

    if (!$user || !password_verify($password, $user->password)) {
        $errors[] = 'Wrong username or password';
    } else {
        $successes = ['User successfully logged'];
        $user->generateNewAccessToken();
    }
}

header('Content-Type: application/json;charset=utf-8');

if (empty($errors)) {
    echo json_encode([        
        'successes' => $successes,
        'access_token' => $user->accessToken,
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}
