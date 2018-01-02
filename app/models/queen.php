<?php

  class Queen extends BaseModel{
      public $queenID, $beekeeperID, $name, $picture, $color, $comments ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }

      public static function all(){
        $query = DB::connection()->prepare('
          SELECT *
          FROM queen
        ');
        $query->execute();
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


}
