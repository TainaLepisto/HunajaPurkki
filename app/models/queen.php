<?php

  class Queen extends BaseModel{
      public $queenID, $beekeeperID, $name, $picture, $location, $comments, $lastInspected ;

      public function __construct($attributes){
        parent::__construct($attributes);
      }



}
