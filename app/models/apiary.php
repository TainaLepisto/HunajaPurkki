<?php

  class Apiary extends BaseModel{
      public $apiaryID, $beekeeperID, $hiveID, $queenID, $name, $picture, $location, $comments, $lastInspected ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }

      public static function all(){
        $query = DB::connection()->prepare('
          SELECT a.*, ai.lastinspected
          FROM apiary AS a
          LEFT JOIN (
            SELECT apiaryid, max(inspectionDate) AS lastinspected
            FROM apiaryinspection
            GROUP BY apiaryid
            ) AS ai
          ON a.apiaryid = ai.apiaryid
        ');
        $query->execute();
        $rows = $query->fetchAll();
        $hives = array();

        foreach($rows as $row){
          $apiarys[] = new Apiary(array(
            'apiaryID' => $row['apiaryid'],
            'beekeeperID' => $row['beekeeperid'],
            'hiveID' => $row['hiveid'],
            'queenID' => $row['queenid'],
            'name' => $row['name'],
            'picture' => $row['picture'],
            'location' => $row['location'],
            'comments' => $row['comments']
            'lastInspected' => $row['lastinspected']
          ));
        }

        return $hives;
      }


      public static function find($id){
         $query = DB::connection()->prepare('
           SELECT a.*, ai.lastinspected
           FROM apiary AS a
           LEFT JOIN (
             SELECT apiaryid, max(inspectionDate) AS lastinspected
             FROM apiaryinspection
             WHERE apiaryid = :id
             GROUP BY apiaryid
             ) AS ai
           ON a.apiaryid = ai.apiaryid
           WHERE apiaryid = :id LIMIT 1
         ');
         $query->execute(array('id' => $id));
         $row = $query->fetch();

         if($row){
           $apiary = new Apiary(array(
             'apiaryID' => $row['apiaryid'],
             'beekeeperID' => $row['beekeeperid'],
             'hiveID' => $row['hiveid'],
             'queenID' => $row['queenid'],
             'name' => $row['name'],
             'picture' => $row['picture'],
             'location' => $row['location'],
             'comments' => $row['comments']
             'lastInspected' => $row['lastInspected']
           ));

           return $apiary;
         }

         return null;
       }



      public static function apiarysOfHive($HiveID){
        $query = DB::connection()->prepare('
          SELECT a.*, ai.lastinspected
          FROM apiary AS a
          LEFT JOIN (
            SELECT apiaryid, max(inspectionDate) AS lastinspected
            FROM apiaryinspection
            WHERE hiveid = :id
            GROUP BY apiaryid
            ) AS ai
          ON a.apiaryid = ai.apiaryid
          WHERE hiveid = :id
        ');
        $query->execute(array('id' => $HiveID));
        $query->execute();
        $rows = $query->fetchAll();
        $hives = array();

        if($rows){
          foreach($rows as $row){
            $apiarys[] = new Apiary(array(
              'apiaryID' => $row['apiaryid'],
              'name' => $row['name'],
              'picture' => $row['picture'],
              'comments' => $row['comments']
              'lastInspected' => $row['lastInspected']
            ));
          }

          return $apiarys;
        }

      return null;

      }


      public function save(){
        // MUISTA RETURNING!
         $query = DB::connection()->prepare('INSERT INTO apiary (hiveid, queenid, name, picture, location, comments) VALUES (:hiveid, :queenid, :name, :picture, :location, :comments) RETURNING apiaryid');
         // HUOM! syntaksi $olio->kenttä
         $query->execute(array('hiveid' => $this->hiveid, 'queenid' => $this->queenid, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
         // napataan talteen olioomme luotu ID tunnus
         $row = $query->fetch();
         $this->apiaryID = $row['apiaryid'];
       }


}
