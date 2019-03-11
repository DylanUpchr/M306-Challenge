<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>,  Jules Bursik <jules.brsk@eduge.ch>
* @version 1.0.0
*/

require_once '../../../../main.php';
use App\{DB, Game};

$errors = [];

/**
 * Validate name.
 *
 * @return string|null
 */
function validateGame() {
    global $errors;

    $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);

    if (!$name) {
        $errors[] = 'Missing parameter name';
        return null;
    }

    $game = Game::findByName($name);

    if (!$game) {
        $errors[] = 'Cannot find game from name value';
        return null;
    }

    return $game;
}

// Validate parameters.
$game = validateGame();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

if (empty($errors)) {
    echo json_encode([
        'successes' => [
            'Game found',
        ],
        'game' => [
            'id' => $game->id,
            'name' => $game->name,
        ],
    ]);
} else {
    echo json_encode([
        'errors' => $errors,
    ]);
}
