<?php

  class ApiaryController extends BaseController{

    public static function listAll(){

      // $hives = Hive::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      // Kint::dump($hives);

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('apiary/apiary-list.html');
    }

    public static function create(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('apiary/apiary-new.html');
    }

     public static function show(){

       // $hive = Hive::find(1);
       // Kint::dump($hive);

       View::make('apiary/apiary-show.html');
     }

     public static function edit(){
       View::make('apiary/apiary-edit.html');
     }

     public static function inspection(){
       View::make('apiary/apiary-inspection.html');
     }

     public static function inspectionForm(){
       View::make('apiary/apiary-inspection-form.html');
     }

  }
