<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Katsotaan onko user-avain sessiossa
         if(isset($_SESSION['user'])){
           $user_id = $_SESSION['user'];
           // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
           $user = User::find($user_id);

           return $user;
         }

         // Käyttäjä ei ole kirjautunut sisään
         return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])){
        Redirect::to('/', array('error' => 'Kirjaudu ensin sisään'));
      }
    }

    public static function check_need_for_login(){
      if(isset($_SESSION['user'])){
        $user = User::find($_SESSION['user']);
        Redirect::to('/login', array('message' => 'Tervetuloa ' . $user->name));
      }
    }

  }
