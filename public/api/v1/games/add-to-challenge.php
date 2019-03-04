<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>, Jules Stahli <jules.sthl@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';
use App\DB;

// Nom des paramètres d'entrée en get
define('PARAM_CHALLENGE_ID', 'challengeId');
define('PARAM_GAME_ID', 'gameId');
define('PARAM_TOKEN_NAME', 'token');

// Filtrage des entrées
$token = filter_input(INPUT_GET, PARAM_TOKEN_NAME, FILTER_SANITIZE_STRING);
$gameId = filter_input(INPUT_GET, PARAM_GAME_ID, FILTER_VALIDATE_INT);
$challengeId = filter_input(INPUT_GET, PARAM_CHALLENGE_ID, FILTER_VALIDATE_INT);

// Autorise les requêtes venant des tiers et défini l'encodage (utf-8) et le type de contenu (json)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

// vérification des conditions de traitement
if (!empty($token) && $gameId and $challengeId) {
    DB::run('INSERT INTO challenge_game (challenge_id, game_id) VALUES ('.$challengeId.', '.$gameId.')');
    reply([
        'status' => 'success'
    ]);
}else{
    reply([
        'status' => 'error',
        'errors' => [
            'Missing parametters gameId or challengeId or token'
        ]
    ]);
}

// functions

/**
 * Affiche les données passée en paramètre sous forme de json et met fin au script
 *
 * @param [array] $response un tableau assissiatif conteant les données a afficher
 * @example Affichage simple
 * $response = [
 *  'status' => 'success',
 *  'other' => [
 *          'data1',
 *          'data2
 *      ]
 * ]
 * ====================>
 * {
 *      "status" = "success",
 *      "other" = [
 *          "data1",
 *          "data2"
 *      ]
 * }
 * @return void
 */
function reply($response){
    echo json_encode($response);
    exit;
}