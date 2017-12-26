<?php

  class HiveController extends BaseController{

    public static function listAll(){

      // $hives = Hive::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      // Kint::dump($hives);

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('hive/hive-list.html');
    }

    public static function create(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('hive/hive-new.html');
    }

     public static function show(){

       // $hive = Hive::find(1);
       // Kint::dump($hive);

       View::make('hive/hive-show.html');
     }

     public static function edit(){
       View::make('hive/hive-edit.html');
     }


  }
