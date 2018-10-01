<?php
require '../../app/common.php';
$taskId = intval($_GET['taskId'] ?? 0);

// if($taskId < 1) {
//     throw new exception('Invalid Task ID');
// }
$work= Work::findByTaskId($taskId);
header ('Content-type: application/json')
echo json_encode($work);
