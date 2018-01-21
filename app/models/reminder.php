<?php

  class Reminder extends BaseModel{
    public $reminderID, $beekeeperID, $title, $reminderDate, $comments, $linkedApiarys ;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_title', 'validate_date');
    }


    public static function all(){
      $query = DB::connection()->prepare("
          SELECT
            r.beekeeperid,
            r.reminderid,
            r.title,
            r.reminderdate,
            r.comments
          FROM reminder AS r
          WHERE r.beekeeperid = :beekeeperid
          ORDER BY reminderdate DESC
      ");
      $query->execute(array('beekeeperid' => $_SESSION['user']));

      $rows = $query->fetchAll();
      $reminders = array();

      foreach($rows as $row){
        $reminders[] = new Reminder(array(
          'reminderID' => $row['reminderid'],
          'beekeeperID' => $row['beekeeperid'],
          'title' => $row['title'],
          'reminderDate' => $row['reminderdate'],
          'comments' => $row['comments'],
          'linkedApiarys' => array()
        ));
      }

      foreach($reminders as $reminder){
        $apiarys[] = array();
        $query2 = DB::connection()->prepare("
            SELECT
              l.apiaryid,
              a.name as apiaryname
            FROM linkreminderapiary AS l
            LEFT JOIN apiary AS a
            ON l.apiaryid = a.apiaryid
            WHERE l.reminderid = :reminderid
        ");
        $query2->execute(array('reminderid' => $reminder->reminderID));
        $rows2 = $query2->fetchAll();
        foreach($rows2 as $row){
            $apiarys[] = array(
              'apiaryID' => $row['apiaryid'],
              'apiaryName' => $row['apiaryname']);
        }
        $reminder->linkedApiarys[] = $apiarys;
      }

      return $reminders;
    }


  public function save(){
    // tähän tarttis oikeesti transaction käsittelyn
      $query = DB::connection()->prepare('
          INSERT INTO reminder
          (beekeeperid, title, reminderdate, comments)
          VALUES
          (:beekeeperid, :title, :reminderdate, :comments)
          RETURNING reminderid');
      $query->execute(array(
        'beekeeperid' => $_SESSION['user'],
        'title' => $this->title,
        'reminderdate' => $this->reminderDate,
        'comments' => $this->comments));

     $row = $query->fetch();
     $this->reminderID = $row['reminderid'];

     foreach($linkedApiarys as $linkedApiary){
       $query = DB::connection()->prepare('
           INSERT INTO linkreminderapiary
           (reminderid, apiaryid)
           VALUES
           (:reminderid, :apiaryid)
           RETURNING linkreminderapiaryid');
       $query->execute(array(
         'reminderid' => $this->reminderID,
         'apiaryid' => $this->apiaryID));

         $row = $query->fetch();
         $this->$linkedApiary = $row['linkreminderapiaryid'];

     }


   }

   public function remove(){
     // tähän tarttis oikeesti transaction käsittelyn
      $query = DB::connection()->prepare('
         DELETE FROM linkreminderapiary
         WHERE reminderid = :id
         AND beekeeperid = :beekeeperid ');
      $query->execute(array('id' => $this->reminderidID, 'beekeeperid' => $_SESSION['user']));
      $query = DB::connection()->prepare('
         DELETE FROM reminder
         WHERE reminderid = :id
         AND beekeeperid = :beekeeperid ');
      $query->execute(array('id' => $this->reminderidID, 'beekeeperid' => $_SESSION['user']));
    }



}
