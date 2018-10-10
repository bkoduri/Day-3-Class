<?php

class WorkHoursReport
{
  public $id;
  public $task_id;
  public $team_id;
  public $start;  //'YYYY-MM-DD'
  public $stop;   //'YYYY-MM-DD', needs to be calculated associative entities
  public $hours;
  public $completion_estimate;
//Get details from db as rows
  public function __construct($row) {
    $this->id = intval($row['id']);
//each column data is extracted
    $this->task_id = intval($row['task_id']);
    $this->team_id = intval($row['team_id']);

    $this->start = $row['start_date'];
    $this->hours = floatval($row['hours']);

    // Calculate stop date
    $hours = floor($this->hours);
    $mins = intval(($this->hours - $hours) * 60); // Take advantage of one decimal place
    $interval = 'PT'. ($hours ? $hours.'H' : '') . ($mins ? $mins.'M' : '');

    $date = new DateTime($this->start);
    $date->add(new DateInterval($interval));
    $this->stop = $date->format('Y-m-d H:i:s');

    $this->completion_estimate = intval($row['completion_estimate']);
  }

  public function create() {
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    $sql = 'INSERT INTO Work (task_id, team_id, start_date, hours, completion_estimate)
            VALUES (?,?,?,?,?)';
    $statement = $db->prepare($sql);
    $success = $statement->execute([
        $this->task_id,
        $this->team_id,
        $this->start,
        $this->hours,
        $this->completion_estimate
    ]);
    if (!$success) {
      //TODO: Better error handling
      die ('Bad SQL on insert');
    }
    $this->id = $db->lastInsertId();
  }



  public static function fetchByProjectId($projectId) {
    // 1. Connect to the database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);

    // 2. Prepare the query
    $sql = 'SELECT DATE(start_date) AS date, SUM(hours) AS hours,
     FROM Work, Tasks WHERE Work.task_id = Tasks.id AND
     Tasks.project_id=? GROUP BY DATE(start_date)';

    $statement = $db->prepare($sql);

    // 3. Run the query
    $success = $statement->execute(
        [$projectId]
    );

    // 4. Handle the results
    $arr = $statement->fetchAll(PDO::FETCH_ASSOC);

    // 4.b. return the array of work objects

    return $arr;
  }
}
