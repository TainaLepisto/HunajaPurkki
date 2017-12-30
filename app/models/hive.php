<?php

  class Hive extends BaseModel{
      public $hiveID, $beekeeperID, $name, $picture, $location, $comments, $countApiarys ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }


      public static function all(){
        $query = DB::connection()->prepare('
          SELECT h.*, a.countapiarys
          FROM hive
          LEFT JOIN (
            SELECT hiveid, count(*) AS countapiarys
            FROM apiary
            GROUP BY hiveid
            ) AS a
          ON h.hiveid = a.hiveid
        ');
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
            'countApiarys' => $row['countapiarys']
          ));
        }

        return $hives;
      }


      public static function find($id){
         $query = DB::connection()->prepare('
            SELECT h.*, a.countapiarys
              FROM hive
              LEFT JOIN (
                SELECT hiveid, count(*) as countapiarys
                FROM apiary
                WHERE hiveid = :id
                GROUP BY hiveid
                ) as a
              ON h.hiveid = a.hiveid
              WHERE h.hiveid = :id LIMIT 1');
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
             'countApiarys' => $row['countapiarys']
           ));

           return $hive;
         }

         return null;
       }


       public function save(){
         // MUISTA RETURNING!
          $query = DB::connection()->prepare('INSERT INTO hive (name, picture, location, comments) VALUES (:name, :picture, :location, :comments) RETURNING hiveid');
          // HUOM! syntaksi $olio->kenttä
          $query->execute(array('name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
          // napataan talteen olioomme luotu ID tunnus
          $row = $query->fetch();
          $this->hiveID = $row['hiveid'];
        }

}
