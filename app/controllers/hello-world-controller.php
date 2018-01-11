<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   	  View::make('home.html');
    }

    public static function createReminder(){
      View::make('reminder/reminder-new.html');
    }

    public static function signup(){
      View::make('signup.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';

      $doom = new Hive(array(
        'name' => 'd',
        'location' => 'irhe'
      ));
      $errors = $doom->errors();

      Kint::dump($errors);
    }


  }
