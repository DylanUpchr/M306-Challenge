<?php
/**
 * Get all the challenges.
 * @author Nicolas Ettlin <nicolas.ettln@eduge.ch>
 * @version 1.0.0
 */
require_once '../../../../main.php';

$challenges = \App\Challenge::all();

header('Content-type: application/json');
echo json_encode([
    'challenges' => $challenges,
]);
