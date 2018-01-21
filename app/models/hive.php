<?php

  class Hive extends BaseModel{
      public $hiveID, $beekeeperID, $name, $picture, $location, $comments, $countApiarys ;

      public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_picture', 'validate_location');
      }


      public static function all(){
        $query = DB::connection()->prepare("
          SELECT
            h.hiveid,
            h.beekeeperid,
            h.name,
            h.picture,
            h.location,
            CASE
              WHEN LENGTH(comments) > 0
              THEN  CONCAT(SUBSTRING(h.comments,0,50),'...')
              ELSE ''
            END AS comments,
            a.countapiarys
          FROM hive AS h
          LEFT JOIN (
            SELECT hiveid, count(*) AS countapiarys
            FROM apiary
            GROUP BY hiveid
            ) AS a
          ON h.hiveid = a.hiveid
          AND h.beekeeperid = :beekeeperid
        ");
        $query->execute(array('beekeeperid' => $_SESSION['user']));
        $rows = $query->fetchAll();
        $hives = array();

        foreach($rows as $row){
          $hives[] = new Hive(array(
            'hiveID' => $row['hiveid'],
            'beekeeperID' => $row['beekeeperid'],
            'name' => $row['name'],
            'picture' => $row['picture'],
            'location' => $row['location'],
            'comments' => $row['comments'],
            'countApiarys' => $row['countapiarys']
          ));
        }

        return $hives;
      }


      public static function find($id){
         $query = DB::connection()->prepare('
            SELECT
                h.*,
                a.countapiarys
            FROM hive AS h
            LEFT JOIN (
                SELECT hiveid, count(*) as countapiarys
                FROM apiary
                GROUP BY hiveid
                ) AS a
            ON h.hiveid = a.hiveid
            AND h.hiveid = :id
            AND h.beekeeperid = :beekeeperid
            LIMIT 1
         ');
         $query->execute(array('id' => $id, 'beekeeperid' => $_SESSION['user']));
         $row = $query->fetch();

         if($row){
           $hive = new Hive(array(
             'hiveID' => $row['hiveid'],
             'beekeeperID' => $row['beekeeperid'],
             'name' => $row['name'],
             'picture' => $row['picture'],
             'location' => $row['location'],
             'comments' => $row['comments'],
             'countApiarys' => $row['countapiarys']
           ));

           return $hive;
         }

         return null;
       }


       public function save(){
         // MUISTA RETURNING!
          $query = DB::connection()->prepare('
              INSERT INTO hive
              (beekeeperid, name, picture, location, comments)
              VALUES
              (:beekeeperid, :name, :picture, :location, :comments)
              RETURNING hiveid');
          // HUOM! syntaksi $olio->kenttä
          $query->execute(array('beekeeperid' => $_SESSION['user'], 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
          // napataan talteen olioomme luotu ID tunnus
          $row = $query->fetch();
          $this->hiveID = $row['hiveid'];
        }

        public function update(){
           $query = DB::connection()->prepare('
              UPDATE hive
                SET
                    name=:name,
                    picture=:picture,
                    location=:location,
                    comments=:comments
              WHERE hiveid = :id
              AND beekeeperid = :beekeeperid
              ');
           $query->execute(array('beekeeperid' => $_SESSION['user'], 'id' => $this->hiveID, 'name' => $this->name, 'picture' => $this->picture, 'location' => $this->location, 'comments' => $this->comments));
         }

        public function remove(){
           $query = DB::connection()->prepare('
              DELETE FROM hive
              WHERE hiveid = :id
              AND beekeeperid = :beekeeperid ');
           $query->execute(array('beekeeperid' => $_SESSION['user'], 'id' => $this->hiveID));
         }



}
