<?php
require_once "../../../../main.php";
use App\DB;

$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_GET, 'password');

$erreur = "";

header('Content-Type: application/json;charset=utf-8');


if (!empty($username) && !empty($password)){
  $data = DB::run('SELECT `access_token`,`password` from users where `username`=?', $username);

  if(password_verify($password, $data[0]["password"])) {    
      //token user
    echo json_encode(["token" => $data[0]["access_token"]]);
    }
    else{
        //erreur 
        $erreur = "L'utilisateur ou le mot de passe est inconnu.";
        echo json_encode(["error" => utf8_encode($erreur)], JSON_UNESCAPED_UNICODE);
    }
}
else{
    $erreur = "Manque de parametres";
    echo json_encode(["error" => utf8_encode($erreur)], JSON_UNESCAPED_UNICODE);
}

