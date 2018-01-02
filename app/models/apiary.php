<?php

  class Apiary extends BaseModel{
      public $apiaryID, $beekeeperID, $hiveID, $hiveName, $queenID, $queenName, $name, $picture, $location, $comments, $lastInspected ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }

      public static function all(){
        $query = DB::connection()->prepare('
          SELECT a.*, ai.lastinspected, h.hivename
          FROM apiary AS a
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
        ');
        $query->execute();
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
        // MUISTA RETURNING!
         $query = DB::connection()->prepare('INSERT INTO apiary (hiveid, queenid, name, picture, location, comments) VALUES (:hiveid, :queenid, :name, :picture, :location, :comments) RETURNING apiaryid');
         // HUOM! syntaksi $olio->kenttä
         $query->execute(array('hiveid' => $this->hiveID, 'queenid' => $this->queenID, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
         // napataan talteen olioomme luotu ID tunnus
         $row = $query->fetch();
         $this->apiaryID = $row['apiaryid'];
       }


}
