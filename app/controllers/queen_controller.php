<?php

  class QueenController extends BaseController{

    public static function listAll(){

      // $hives = Hive::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      // Kint::dump($hives);

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('queen/queen-list.html');
    }

    public static function create(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('queen/queen-new.html');
    }

     public static function show(){

       // $hive = Hive::find(1);
       // Kint::dump($hive);

       View::make('queen/queen-show.html');
     }

     public static function edit(){
       View::make('queen/queen-edit.html');
     }

     public static function inspection(){
       View::make('queen/queen-inspection.html');
     }

  }
