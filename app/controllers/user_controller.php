<?php

  class UserController extends BaseController{

    public static function handle_signup(){
      $params = $_POST;

      $passwrd1 = $params['inputPassword'] ;
      $passwrd2 = $params['inputPassword2'] ;

      if($passwrd1 != $passwrd2){
        View::make('signup.html', array('error' => 'Salasanat eivät täsmää', 'userName' => $params['inputBeekeeperName'], 'userEmail' => $params['inputEmail']));
      }

      $user = User::find_email($params['inputEmail']);

      if($user){
        View::make('signup.html', array('error' => 'Sähköpostiosoite on jo käytössä', 'userName' => $params['inputBeekeeperName'], 'userEmail' => $params['inputEmail']));
      } else{
        $user = User::createAccount($params['inputEmail'],$params['inputPassword'], $params['inputBeekeeperName']);
        $_SESSION['user'] = $user->userID;
        Redirect::to('/login', array('message' => 'Tervetuloa ' . $user->name));
      }
  }


    public static function handle_login(){
      $params = $_POST;

      $user = User::authenticate($params['inputEmail'], $params['inputPassword']);

      if(!$user){
        View::make('home.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['inputEmail']));
      }else{
        $_SESSION['user'] = $user->userID;

        Redirect::to('/login', array('message' => 'Tervetuloa ' . $user->name));
      }
    }

    public static function handle_logout(){
      $_SESSION['user'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos'));
    }

    public static function login(){
      View::make('login.html');
    }

  }
