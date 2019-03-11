<?php
/**
* @author Jules Stahli <jules.sthl@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';
use App\DB;

// Nom des paramètres d'entrée en get

define('PARAM_TOKEN_NAME', 'token');
define('PARAM_GAME_NAME', 'gameName');

// Filtrage des entrées
$token = filter_input(INPUT_POST, PARAM_TOKEN_NAME, FILTER_SANITIZE_STRING);
$gameName = filter_input(INPUT_POST, PARAM_GAME_NAME, FILTER_SANITIZE_STRING);

// Autorise les requêtes venant des tiers et défini l'encodage (utf-8) et le type de contenu (json)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

// vérification des conditions de traitement
if (!empty($token) && !empty($gameName)) {
    if (USER::findByAccessToken($token) != null) {
        try {
            DB::run('INSERT INTO games (name) VALUES (?)', $gameName);
            reply([
                'status' => 'success'
            ]);
        } catch (\Error $e) {
            reply([
                'status' => 'error',
                'errors' => ['SQL error']
            ]);
        }
    }else{
        reply([
            'status' => 'error',
            'errors' => ['Missing token']
        ]);
    }
} else {
    reply([
        'status' => 'error',
        'errors' => [
            'Missing game name'
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
function reply($response)
{
    echo json_encode($response);
    exit;
}

