<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>,  Jules Bursik <jules.brsk@eduge.ch>
* @version 1.0.0
*/

require_once '../../main.php';
use App\{ Game};

$errors = [];

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    echo json_encode([
        'games' => Game::all(),
    ]);
}
