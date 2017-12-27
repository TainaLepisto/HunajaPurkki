<?php

  class HiveController extends BaseController{

    public static function listAll(){

      $hives = Hive::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      //Kint::dump($hives);

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('hive/hive-list.html', array('hives' => $hives));
    }

    public static function create(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('hive/hive-new.html');
    }

     public static function show($id){
       $hive = Hive::find($id);
       $apiarysOfHive = Apiary::apiarysOfHive($id);

       View::make('hive/hive-show.html', array('hive' => $hive, 'apiarys' => $apiarysOfHive));
     }

     public static function edit(){
       View::make('hive/hive-edit.html');
     }


// staattiset opelle
     public static function staticlist(){
       View::make('hive/hive-static-list.html');
     }
     public static function staticshow(){
      View::make('hive/hive-static-show.html');
    }
    public static function staticedit(){
       View::make('hive/hive-static-edit.html');
    }


  }
