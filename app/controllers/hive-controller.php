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


    public static function saveNew(){
      // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
      $params = $_POST;
      // Alustetaan uusi hive-luokan olion käyttäjän syöttämillä arvoilla
      $hive = new Hive(array(
        'name' => $params['name'],
        'picture' => $params['picture'],
        'location' => $params['location'],
        'comments' => $params['comments']
      ));

      // tarkastetaan onko arvot sallittuja
      $errors = $hive->errors();

      if(count($errors) == 0){
        $hive->save();
        Redirect::to('/hive/' . $hive->hiveID, array('message' => 'Tarha on lisätty!'));
      }else{
        View::make('hive/hive-new.html', array('errors' => $errors, 'attributes' => $hive));
      }

     }


     public static function show($id){
       $hive = Hive::find($id);
       $apiarysOfHive = Apiary::apiarysOfHive($id);
       View::make('hive/hive-show.html', array('hive' => $hive, 'apiarys' => $apiarysOfHive));
     }

     public static function edit($id){
       $hive = Hive::find($id);
       View::make('hive/hive-edit.html', array('hive' => $hive));
     }



  }
