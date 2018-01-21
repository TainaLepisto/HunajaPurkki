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
            h.name AS hivename
          FROM apiary AS a
          LEFT JOIN (
            SELECT apiaryid, max(inspectionDate) AS lastinspected
            FROM apiaryinspection
            GROUP BY apiaryid
            ) AS ai
          ON a.apiaryid = ai.apiaryid
          LEFT JOIN hive AS h
          on a.hiveid = h.hiveid
          WHERE a.beekeeperid = :beekeeperid
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
           SELECT
              a.*,
              ai.lastinspected,
              q.name AS queenname,
              h.name AS hivename
           FROM apiary AS a
           LEFT JOIN (
                 SELECT apiaryid, max(inspectionDate) AS lastinspected
                 FROM apiaryinspection
                 WHERE apiaryid = :id
                 GROUP BY apiaryid
                 ) AS ai
              ON a.apiaryid = ai.apiaryid
           LEFT JOIN queen AS q
              ON a.queenid = q.queenid
           LEFT JOIN hive AS h
              on a.hiveid = h.hiveid
           WHERE a.apiaryid = :id
              AND a.beekeeperid = :beekeeperid
           LIMIT 1
         ');
         $query->execute(array('id' => $id, 'beekeeperid' => $_SESSION['user']));
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

           $apiary->validateHiveForView();
           $apiary->validateQueenForView();

           return $apiary;
         }

         return null;
       }



      public static function apiarysOfHive($id){
        $query = DB::connection()->prepare('
          SELECT
              a.*,
              ai.lastinspected
          FROM apiary AS a
          LEFT JOIN (
            SELECT apiaryid, max(inspectionDate) AS lastinspected
            FROM apiaryinspection
            GROUP BY apiaryid
            ) AS ai
          ON a.apiaryid = ai.apiaryid
          WHERE a.hiveid = :id
          AND a.beekeeperid = :beekeeperid
        ');
        $query->execute(array('id' => $id,'beekeeperid' => $_SESSION['user']));
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

      public static function allWithoutQueen(){
        $query = DB::connection()->prepare('
          SELECT apiaryid, name
          FROM apiary
          WHERE beekeeperid = :beekeeperid
            AND queenid IS NULL
        ');
        $query->execute(array('beekeeperid' => $_SESSION['user']));

        $query->execute();
        $rows = $query->fetchAll();
        $apiarys = array();

        foreach($rows as $row){
          $apiarys[] = new Apiary(array(
            'apiaryID' => $row['apiaryid'],
            'name' => $row['name']
          ));
        }

        return $apiarys;
      }

      public static function allWithoutQueenAndOne($id){
        $query = DB::connection()->prepare('
          SELECT apiaryid, name
          FROM apiary
          WHERE beekeeperid = :beekeeperid
            AND (queenid IS NULL OR
                queenid = :id )
        ');
        $query->execute(array('beekeeperid' => $_SESSION['user'], 'id' => $id));

        $query->execute();
        $rows = $query->fetchAll();
        $apiarys = array();

        foreach($rows as $row){
          $apiarys[] = new Apiary(array(
            'apiaryID' => $row['apiaryid'],
            'name' => $row['name']
          ));
        }

        return $apiarys;
      }

      public function save(){
          $this->validateHiveForDB();
          $this->validateQueenForDB();

          $query = DB::connection()->prepare('
              INSERT INTO apiary
              (beekeeperid, hiveid, queenid, name, picture, location, comments)
              VALUES
              (:beekeeperid, :hiveid, :queenid, :name, :picture, :location, :comments)
              RETURNING apiaryid');
          $query->execute(array('beekeeperid' => $_SESSION['user'], 'hiveid' => $this->hiveID, 'queenid' => $this->queenID, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));

         $row = $query->fetch();
         $this->apiaryID = $row['apiaryid'];
       }

       public function update(){
           $this->validateHiveForDB();
           $this->validateQueenForDB();

           $query = DB::connection()->prepare('
               UPDATE apiary
                 SET
                    hiveid=:hiveid,
                    queenid=:queenid,
                    name=:name,
                    picture=:picture,
                    location=:location,
                    comments=:comments
               WHERE apiaryid = :id
               AND beekeeperid = :beekeeperid ');
           $query->execute(array('beekeeperid' => $_SESSION['user'], 'id' => $this->apiaryID, 'hiveid' => $this->hiveID, 'queenid' => $this->queenID, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
        }

        public function remove(){
           $query = DB::connection()->prepare('
              DELETE FROM apiary
              WHERE apiaryid = :id
              AND beekeeperid = :beekeeperid ');
           $query->execute(array('id' => $this->apiaryID, 'beekeeperid' => $_SESSION['user']));
         }

        public function validateHiveForDB(){
          if ($this->hiveID == '-1'){
            $this->hiveID = NULL ;
          }
        }
        public function validateQueenForDB(){
          if ($this->queenID == '-1'){
            $this->queenID = NULL ;
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
