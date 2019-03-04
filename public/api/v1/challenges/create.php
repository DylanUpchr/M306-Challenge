<?php
/**
* @author Jules Stahli <jules.sthl@eduge.ch>, Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>
* @version 1.0.0
*/
require_once '../../../../main.php';
use App\DB;

// Nom du paramètre d'entrée en get
define('PARAM_CHALLENGE_NAME', 'name');
define('PARAM_TOKEN_NAME', 'token');
define('DUREE_CHALLENGE', 1000000); //timestamp actuellement 1jour

// Filtrage des paramètre get
$challengeName = filter_input(INPUT_POST, PARAM_CHALLENGE_NAME, FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_POST, PARAM_TOKEN_NAME, FILTER_SANITIZE_STRING);

// Autorise les requêtes venant des tiers et défini l'encodage (utf-8) et le type de contenu (json)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST');

// vérification des conditions de traitement
if (!empty($token) && !empty($challengeName)) {
    // Insertion d'un nouveau challenge dans la base
    DB::run('INSERT INTO challenges (name, start_date, end_date) VALUES ("'.$challengeName.'", NOW(), NOW() + '.DUREE_CHALLENGE.')');
    Reply([
        'status' => 'success'
    ]);
}else{
    // Répondre une erreur
    Reply([
        'status' => 'error',
        'errors' => [
            PARAM_CHALLENGE_NAME.' is required'
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
function Reply($response){
    echo json_encode($response);
    exit;
}
