<?php

  class Queen extends BaseModel{
      public $queenID, $beekeeperID, $name, $picture, $color, $comments, $apiaryID, $apiaryName ;

      public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_picture');
      }

      public static function all(){
        $query = DB::connection()->prepare("
          SELECT
              q.beekeeperid,
              q.queenid,
              q.name,
              q.picture,
              q.color,
              CASE
                WHEN LENGTH(q.comments) > 0
                THEN  CONCAT(SUBSTRING(q.comments,0,50),'...')
                ELSE ''
              END AS comments
          FROM queen AS q
          WHERE q.beekeeperid = :beekeeperid
        ");
        $query->execute(array('beekeeperid' => $_SESSION['user']));
        $rows = $query->fetchAll();
        $queens = array();

        foreach($rows as $row){
          $queens[] = new Queen(array(
            'queenID' => $row['queenid'],
            'beekeeperID' => $row['beekeeperid'],
            'name' => $row['name'],
            'picture' => $row['picture'],
            'color' => $row['color'],
            'comments' => $row['comments']
          ));
        }

        return $queens;
      }


      public static function find($id){
         $query = DB::connection()->prepare('
           SELECT
              q.*,
              a.apiaryid,
              a.name AS apiaryname
           FROM queen AS q
           LEFT JOIN apiary AS a
              ON q.queenid = a.queenid
           WHERE q.queenid = :id
              AND q.beekeeperid = :beekeeperid
           LIMIT 1
         ');
         $query->execute(array('id' => $id, 'beekeeperid' => $_SESSION['user']));
         $row = $query->fetch();

         if($row){
           $queen = new Queen(array(
             'queenID' => $row['queenid'],
             'beekeeperID' => $row['beekeeperid'],
             'apiaryID' => $row['apiaryid'],
             'apiaryName' => $row['apiaryname'],
             'name' => $row['name'],
             'picture' => $row['picture'],
             'color' => $row['color'],
             'comments' => $row['comments']
           ));

           return $queen;
         }

         return null;
       }


      public function save(){
          $query = DB::connection()->prepare('
              INSERT INTO queen
              (beekeeperid, name, picture, color, comments)
              VALUES
              (:beekeeperid, :name, :picture, :color, :comments)
              RETURNING queenid');
          $query->execute(array(
              'beekeeperid' => $_SESSION['user'],
              'name' => $this->name,
              'picture' => $this->picture,
              'color' => $this->color,
              'comments' => $this->comments
            ));

         $row = $query->fetch();
         $this->queenID = $row['queenid'];
       }

       public function update(){
           $query = DB::connection()->prepare('
               UPDATE queen
                 SET
                    name=:name,
                    picture=:picture,
                    color=:color,
                    comments=:comments
               WHERE queenid = :id
               AND beekeeperid = :beekeeperid ');
           $query->execute(array(
             'beekeeperid' => $_SESSION['user'],
             'id' => $this->apiaryID,
             'name' => $this->name,
             'picture' => $this->picture,
             'color' => $this->color,
             'comments' => $this->comments
           ));
        }

        public function remove(){
           $query = DB::connection()->prepare('
              DELETE FROM queen
              WHERE queenid = :id
              AND beekeeperid = :beekeeperid ');
           $query->execute(array(
             'id' => $this->queenID,
             'beekeeperid' => $_SESSION['user']));
         }


}
