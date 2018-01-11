<?php

  class Reminder extends BaseModel{
    public $reminderID, $beekeeperID, $title, $reminderdate, $comments, $$selectedApiarys ;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_title', 'validate_date');
    }


    public static function all(){
      $query = DB::connection()->prepare("
          SELECT * from reminder
          WHERE beekeeperid = :beekeeperid
      ");
      $query->execute(array('beekeeperid' => $_SESSION['user']));


}
