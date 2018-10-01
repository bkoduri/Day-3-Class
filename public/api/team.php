<?php
require '../../app/common.php';
$taskId = intval($_GET['teamId'] ?? 0);

// if($taskId < 1) {
//     throw new exception('Invalid Task ID');
// }
$teams = Team::findAll($teamId);
header ('Content-type: application/json')
echo json_encode($teams);
