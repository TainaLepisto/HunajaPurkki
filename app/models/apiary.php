<?php

  class Apiary extends BaseModel{
      public $apiaryID, $beekeeperID, $hiveID, $hiveName, $queenID, $queenName, $name, $picture, $location, $comments, $lastInspected ;

      public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_picture', 'validate_location');
      }

      public static function all(){
        $query = DB::connection()->prepare("
          SELECT
            a.apiaryid,
            a.beekeeperid,
            a.hiveid,
            a.queenid,
            a.name,
            a.picture,
            a.location,
            CASE
              WHEN LENGTH(a.comments) > 0
              THEN  CONCAT(SUBSTRING(a.comments,0,50),'...')
              ELSE ''
            END AS comments,
            ai.lastinspected,
            h.hivename
          FROM (
            SELECT *
            FROM apiary
            WHERE beekeeperid = :beekeeperid
            ) AS a
          LEFT JOIN (
            SELECT apiaryid, max(inspectionDate) AS lastinspected
            FROM apiaryinspection
            GROUP BY apiaryid
            ) AS ai
          ON a.apiaryid = ai.apiaryid
          LEFT JOIN (
            SELECT hiveid, name AS hivename
            FROM hive
            ) AS h
          on a.hiveid = h.hiveid
        ");
        $query->execute(array('beekeeperid' => $_SESSION['user']));

        $rows = $query->fetchAll();
        $apiarys = array();

        foreach($rows as $row){
          $apiarys[] = new Apiary(array(
            'apiaryID' => $row['apiaryid'],
            'beekeeperID' => $row['beekeeperid'],
            'hiveID' => $row['hiveid'],
            'hiveName' => $row['hivename'],
            'queenID' => $row['queenid'],
            'name' => $row['name'],
            'picture' => $row['picture'],
            'location' => $row['location'],
            'comments' => $row['comments'],
            'lastInspected' => $row['lastinspected']
          ));
        }

        return $apiarys;
      }


      public static function find($id){
         $query = DB::connection()->prepare('
           SELECT a.*, ai.lastinspected, q.queenname, h.hivename
           FROM (
             SELECT * FROM apiary
             WHERE apiaryid = :id) AS a
           LEFT JOIN (
             SELECT apiaryid, max(inspectionDate) AS lastinspected
             FROM apiaryinspection
             WHERE apiaryid = :id
             GROUP BY apiaryid
             ) AS ai
           ON a.apiaryid = ai.apiaryid
           LEFT JOIN (
             SELECT queenid, name AS queenname
             FROM queen
             ) AS q
           ON a.queenid = q.queenid
           LEFT JOIN (
             SELECT hiveid, name AS hivename
             FROM hive
             ) AS h
           on a.hiveid = h.hiveid
           LIMIT 1
         ');
         $query->execute(array('id' => $id));
         $row = $query->fetch();

         if($row){
           $apiary = new Apiary(array(
             'apiaryID' => $row['apiaryid'],
             'beekeeperID' => $row['beekeeperid'],
             'hiveID' => $row['hiveid'],
             'hiveName' => $row['hivename'],
             'queenID' => $row['queenid'],
             'queenName' => $row['queenname'],
             'name' => $row['name'],
             'picture' => $row['picture'],
             'location' => $row['location'],
             'comments' => $row['comments'],
             'lastInspected' => $row['lastinspected']
           ));

           return $apiary;
         }

         return null;
       }



      public static function apiarysOfHive($id){
        $query = DB::connection()->prepare('
          SELECT a.*, ai.lastinspected
          FROM (
            SELECT * FROM apiary
            WHERE hiveid = :id) AS a
          LEFT JOIN (
            SELECT apiaryid, max(inspectionDate) AS lastinspected
            FROM apiaryinspection
            GROUP BY apiaryid
            ) AS ai
          ON a.apiaryid = ai.apiaryid
        ');
        $query->execute(array('id' => $id));
        $query->execute();
        $rows = $query->fetchAll();
        $apiarys = array();

        foreach($rows as $row){
          $apiarys[] = new Apiary(array(
            'apiaryID' => $row['apiaryid'],
            'name' => $row['name'],
            'picture' => $row['picture'],
            'comments' => $row['comments'],
            'lastInspected' => $row['lastinspected']
          ));
        }

        return $apiarys;
      }


      public function save(){
          $query = DB::connection()->prepare('INSERT INTO apiary (beekeeperid, hiveid, queenid, name, picture, location, comments) VALUES (:beekeeperid, :hiveid, :queenid, :name, :picture, :location, :comments) RETURNING apiaryid');
          $query->execute(array('beekeeperid' => $this->beekeeperID, 'hiveid' => $this->hiveID, 'queenid' => $this->queenID, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));

         $row = $query->fetch();
         $this->apiaryID = $row['apiaryid'];
       }

       public function update(){
           $query = DB::connection()->prepare('
               UPDATE apiary
                 SET hiveid=:hiveid, queenid=:queenid, name=:name, picture=:picture, location=:location, comments=:comments
               WHERE apiaryid = :id ');
           $query->execute(array('id' => $this->apiaryID, 'hiveid' => $this->hiveID, 'queenid' => $this->queenID, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
        }

        public function remove(){
           $query = DB::connection()->prepare('DELETE FROM apiary WHERE apiaryid = :id ');
           $query->execute(array('id' => $this->apiaryID));
         }

        public function validateHiveForDB(){
          if ($this->hiveID == '-1'){
            $this->hiveID = 'null';
          }
        }
        public function validateQueenForDB(){
          if ($this->queenID == '-1'){
            $this->queenID = 'null';
          }
        }
        public function validateHiveForView(){
          if ($this->hiveID == ''){
            $this->hiveID = '-1';
          }
        }
        public function validateQueenForView(){
          if ($this->queenID == ''){
            $this->queenID = '-1';
          }
        }


}
