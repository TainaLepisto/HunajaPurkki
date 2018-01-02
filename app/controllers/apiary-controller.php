<?php

  class ApiaryController extends BaseController{

    public static function listAll(){
      $apiarys = Apiary::all();
   	  View::make('apiary/apiary-list.html', array('apiarys' => $apiarys));
    }

    public static function create(){
      $hives = Hive::all();
      $queens = Queen::all();

      View::make('apiary/apiary-new.html', array('hives' => $hives, 'queens' => $queens));
    }

    public static function createForHive($hiveID){
      $hives = Hive::all();
      $queens = Queen::all();

      View::make('apiary/apiary-new.html', array('hives' => $hives, 'selectedHive' => $hiveID, 'queens' => $queens));
    }

    public static function saveNew(){
      $params = $_POST;
      $apiary = new Apiary(array(
        'hiveID' => $params['selectHive'],
        'queenID' => $params['selectQueen'],
        'name' => $params['name'],
        'picture' => $params['picture'],
        'location' => $params['location'],
        'comments' => $params['comments']
      ));
      $apiary->save();
      Redirect::to('/apiary/' . $apiary->apiaryID, array('message' => 'Pesä on lisätty!'));
    }

     public static function show($id){
       $apiary = Apiary::find($id);
       View::make('apiary/apiary-show.html', array('apiary' => $apiary));
     }

     public static function edit($id){
       $apiary = Apiary::find($id);
       $hives = Hive::all();

       View::make('apiary/apiary-edit.html', array('apiary' => $apiary, 'hives' => $hives));
     }

     public static function inspection($id){
       View::make('apiary/apiary-inspection.html');
     }

     public static function inspectionForm($id){
       View::make('apiary/apiary-inspection-form.html');
     }

  }
