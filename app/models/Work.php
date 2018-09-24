<?php
class Work
{

  public $work_id;
  public $task_id;
  public $team_id;
  public $start_date;
  public $stop_date;
  public function _construct($row) {
    $this->id=$row['id'];
    $this->start_date = $row['start_date'];
    $this->end_date = $row['end_date'];

  }

public static function getAllWorkByTask(int $taskId){
//create  Db
$db= new PDO(DB_SERVER, DB_USER, DB_PW)
var_dump($db);
die;
}
}
