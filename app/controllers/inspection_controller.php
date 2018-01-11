<?php

  class InspectionController extends BaseController{

    public static function listAll(){

      // $hives = Hive::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      // Kint::dump($hives);

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('inspection/inspection_list.html');
    }

    public static function create(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('inspection/inspection_new.html');
    }

     public static function show(){

       // $hive = Hive::find(1);
       // Kint::dump($hive);

       View::make('inspection/inspection_show.html');
     }

     public static function edit(){
       View::make('inspection/inspection_edit.html');
     }


  }
