<?php
require_once "../../../../main.php";
use App\DB;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT);
$firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
$accessToken = sha1(uniqid());
$erreur = "";

header('Content-Type: application/json;charset=utf-8');


if (!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($accessToken)){
    DB::run('INSERT INTO `users`(`username`, `password`, `first_name`, `last_name`, `access_token`) VALUES (?,?,?,?,?)', $username, $password, $firstName, $lastName, $accessToken);
    echo json_encode(["token" => $accessToken]);
}
else{
    $erreur = "Manque de param�tres.";
    echo json_encode(["error" => utf8_encode($erreur)], JSON_UNESCAPED_UNICODE);
}

