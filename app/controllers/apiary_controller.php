<?php

  class ApiaryController extends BaseController{

    public static function listAll(){
      $apiarys = Apiary::all();
   	  View::make('apiary/apiary_list.html', array('apiarys' => $apiarys));
    }

    public static function create(){
      $hives = Hive::all();
      $queens = Queen::all();

      View::make('apiary/apiary_new.html', array('hives' => $hives, 'queens' => $queens));
    }

    public static function createForHive($hiveID){
      $hives = Hive::all();
      $queens = Queen::all();
      $attributes = array('hiveID' => $hiveID);

      View::make('apiary/apiary_new.html', array('hives' => $hives, 'queens' => $queens, 'attributes' => $attributes));
    }

    public static function saveNew(){
      $params = $_POST;

      $apiary = new Apiary(array(
        'beekeeperID' => $_SESSION['user'],
        'hiveID' => $params['selectHive'],
        'queenID' => $params['selectQueen'],
        'name' => $params['name'],
        'picture' => $params['picture'],
        'location' => $params['location'],
        'comments' => $params['comments']
      ));

      // tarkastetaan onko arvot sallittuja
      $errors = $apiary->errors();

      if(count($errors) == 0){
          $apiary->save();
          Redirect::to('/apiary/' . $apiary->apiaryID, array('message' => 'Pesä on lisätty!'));
      }else{
          $hives = Hive::all();
          $queens = Queen::all();
          View::make('apiary/apiary_new.html', array('errors' => $errors, 'attributes' => $apiary, 'hives' => $hives, 'queens' => $queens));
      }
    }

     public static function show($id){
       $apiary = Apiary::find($id);
       View::make('apiary/apiary_show.html', array('apiary' => $apiary));
     }

     public static function edit($id){
       $apiary = Apiary::find($id);
       $hives = Hive::all();
       $queens = Queen::all();

       View::make('apiary/apiary_edit.html', array('apiary' => $apiary, 'hives' => $hives, 'queens' => $queens));
     }

     public static function update($id){
       $params = $_POST;

       $apiary = new Apiary(array(
         'apiaryID' => $id,
         'hiveID' => $params['selectHive'],
         'queenID' => $params['selectQueen'],
         'name' => $params['name'],
         'picture' => $params['picture'],
         'location' => $params['location'],
         'comments' => $params['comments']
       ));

       // tarkastetaan onko arvot sallittuja
       $errors = $apiary->errors();

       if(count($errors) == 0){
           $apiary->update();
           Redirect::to('/apiary/' . $apiary->apiaryID, array('message' => 'Pesän tiedot on päivitetty'));
       }else{
           $hives = Hive::all();
           $queens = Queen::all();
           View::make('apiary/apiary_edit.html', array('errors' => $errors, 'apiary' => $apiary, 'hives' => $hives, 'queens' => $queens));
       }
     }


     public static function remove($id){
       $apiary = new Apiary(array('apiaryID' => $id));
       $apiary->remove();
       Redirect::to('/apiary', array('message' => 'Pesä on poistettu onnistuneesti'));
     }


     public static function inspection($id){
       $apiary = Apiary::find($id);
       View::make('apiary/apiary_inspection.html', array('apiary' => $apiary));
     }

     public static function inspectionForm($id){
       $apiary = Apiary::find($id);
       View::make('apiary/apiary_inspection_form.html', array('apiary' => $apiary));
     }

  }
