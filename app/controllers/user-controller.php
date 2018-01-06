<?php

  class UserController extends BaseController{

    public static function handle_login(){
      $params = $_POST;

      $user = User::authenticate($params['inputEmail'], $params['inputPassword']);

      if(!$user){
        View::make('home.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['inputEmail']));
      }else{
        $_SESSION['user'] = $user->userID;

        Redirect::to('/login', array('message' => 'Tervetuloa ' . $user->name . '.'));
      }
    }

    public static function login(){
      View::make('login.html');
    }

  }
