<?php
/**
 * Get all the challenges.
 * @author Nicolas Ettlin <nicolas.ettln@eduge.ch>
 * @version 1.0.0
 */
require_once '../../../../main.php';

$challenges = \App\Challenge::all();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-type');
header('Content-type: application/json; charset=utf-8');

echo json_encode([
    'challenges' => $challenges,
]);
