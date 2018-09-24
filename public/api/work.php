<?php
require:'../../app/common.php';
$taskId = intval($_GET['taskId'] ?? 0);

if($taskId < 1) {
    throw new exception('Invalid Task ID');
}
$workArr= Work::getAllWorkByTask($taskId);
$json=json_encode($workArr);

echo $json;
