<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  <?php

  $workHours = new WorkHours($_POST);
  $workHours->create();
  echo json_encode($workHours);
  exit;
}

$projectId = intval($_GET['projectId'] ?? 0);

if ($projectId < 1) {
  throw new Exception('Invalid $project ID');
}


// 1. Go to the database and get all work associated with the $taskId
$workArr = WorkHoursReport::fetchByProjectId($projectId);

// 2. Convert to JSON
$json = json_encode($workArr, JSON_PRETTY_PRINT);

// 3. Print
header('Content-Type: application/json');
echo $json;
