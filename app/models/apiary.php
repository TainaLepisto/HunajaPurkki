<?php

  class Apiary extends BaseModel{
      public $apiaryID, $beekeeperID, $hiveID, $queenID, $name, $picture, $location, $comments, $lastInspected ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }

      public static function all(){
        // TODO: alikysely lastInspected
        $query = DB::connection()->prepare('SELECT * FROM apiary');
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
//            'lastInspected' => $row['lastInspected']
          ));
        }

        return $hives;
      }


      public static function find($id){
        // TODO: alikysely lastInspected
         $query = DB::connection()->prepare('SELECT * FROM apiary WHERE apiaryid = :id LIMIT 1');
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
 //            'lastInspected' => $row['lastInspected']
           ));

           return $apiary;
         }

         return null;
       }



      public static function apiarysOfHive($HiveID){
        $query = DB::connection()->prepare('SELECT * FROM apiary WHERE hiveid = :id');
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
  //          lastInspected => TODO:
            ));
          }

          return $apiarys;
        }

      return null;

      }



}
