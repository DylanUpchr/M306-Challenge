<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>,  Jules Bursik <jules.brsk@eduge.ch>
* @version 1.0.0
*/

require_once '../../main.php';
use App\{DB, User};

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password');
$errors = [];

// Validate parameters.
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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    echo json_encode([        
        'successes' => $successes,
        'accessToken' => $user->accessToken,
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}
