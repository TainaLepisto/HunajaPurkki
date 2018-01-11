<?php

  class QueenController extends BaseController{

    public static function listAll(){

      // $hives = Hive::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      // Kint::dump($hives);

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('queen/queen_list.html');
    }

    public static function create(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('queen/queen_new.html');
    }

     public static function show(){

       // $hive = Hive::find(1);
       // Kint::dump($hive);

       View::make('queen/queen_show.html');
     }

     public static function edit(){
       View::make('queen/queen_edit.html');
     }

     public static function inspection(){
       View::make('queen/queen_inspection.html');
     }

     public static function inspectionForm(){
       View::make('queen/queen_inspection_form.html');
     }

  }
