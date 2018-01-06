<?php

  class User extends BaseModel{
    public $userID, $name ;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function authenticate($user, $psw){
      $query = DB::connection()->prepare('SELECT beekeeperid, name FROM beekeeper WHERE email = :user AND password = :psw LIMIT 1');
      $query->execute(array('user' => $user, 'psw' => $psw));
      $row = $query->fetch();
      if($row){
        return new User(array('userID' => $row['beekeeperid'], 'name' => $row['name']));
      }else{
        return null ;
      }
    }


}
