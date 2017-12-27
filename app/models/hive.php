<?php

  class Hive extends BaseModel{
      public $hiveID, $beekeeperID, $name, $picture, $location, $comments, $countApiarys ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }


      public static function all(){
        // TODO: alikysely countApiarys
        $query = DB::connection()->prepare('SELECT * FROM hive');
        $query->execute();
        $rows = $query->fetchAll();
        $hives = array();

        foreach($rows as $row){
          $hives[] = new Hive(array(
            'hiveID' => $row['hiveid'],
            'beekeeperID' => $row['beekeeperid'],
            'name' => $row['name'],
            'picture' => $row['picture'],
            'location' => $row['location'],
            'comments' => $row['comments']
//            'countApiarys' => $row['countapiarys']
          ));
        }

        return $hives;
      }


      public static function find($id){
        // TODO: alikysely countApiarys
         $query = DB::connection()->prepare('SELECT * FROM hive WHERE hiveid = :id LIMIT 1');
         $query->execute(array('id' => $id));
         $row = $query->fetch();

         if($row){
           $hive = new Hive(array(
             'hiveID' => $row['hiveid'],
             'beekeeperID' => $row['beekeeperid'],
             'name' => $row['name'],
             'picture' => $row['picture'],
             'location' => $row['location'],
             'comments' => $row['comments']
//             'countApiarys' => $row['countApiarys']
           ));

           return $hive;
         }

         return null;
       }


}
