<?php

  class QueenController extends BaseController{

    public static function listAll(){
      $queens = Queen::all();
   	  View::make('queen/queen_list.html', array('queens' => $queens));
    }

    public static function create(){
      $apiarys = Apiary::allWithoutQueen();
      View::make('queen/queen_new.html', array('apiarys' => $apiarys));
    }

    public static function saveNew(){
      $params = $_POST;

      $queen = new Queen(array(
        'beekeeperID' => $_SESSION['user'],
        'name' => $params['name'],
        'picture' => $params['picture'],
        'color' => $params['color'],
        'comments' => $params['comments']
      ));

      // tarkastetaan onko arvot sallittuja
      $errors = $queen->errors();

      if(count($errors) == 0){
          $queen->save();
          Redirect::to('/queen/' . $queen->queenID, array('message' => 'Emo on lisätty!'));
      }else{
          $apiarys = Apiary::allWithoutQueen();
          View::make('queen/queen_new.html', array('errors' => $errors, 'attributes' => $queen, 'apiarys' => $apiarys));
      }
    }

     public static function show($id){
       $queen = Queen::find($id);
       View::make('queen/queen_show.html', array('queen' => $queen));
     }

     public static function edit($id){
       $apiarys = Apiary::allWithoutQueenAndOne($id);
       $queen = Queen::find($id);
       View::make('queen/queen_edit.html', array('apiarys' => $apiarys, 'queen' => $queen));
     }

     public static function update($id){
       $params = $_POST;

       $queen = new Queen(array(
         'queenID' => $id,
         'name' => $params['name'],
         'picture' => $params['picture'],
         'color' => $params['color'],
         'comments' => $params['comments']
       ));

       // tarkastetaan onko arvot sallittuja
       $errors = $queen->errors();

       if(count($errors) == 0){
           $queen->update();
           Redirect::to('/queen/' . $queen->queenID, array('message' => 'Emon tiedot on päivitetty'));
       }else{
           $apiarys = Apiary::allWithoutQueenAndOne($id);
           View::make('queen/queen_edit.html', array('errors' => $errors, 'apiarys' => $apiarys, 'queen' => $queen));
       }
     }


     public static function remove($id){
       $queen = new Queen(array('queenID' => $id));
       $queen->remove();
       Redirect::to('/queen', array('message' => 'Emo on poistettu onnistuneesti'));
     }

     public static function inspection($id){
       $queen = Queen::find($id);
       View::make('queen/queen_inspection.html', array('queen' => $queen));
     }

     public static function inspectionForm($id){
       $queen = Queen::find($id);
       View::make('queen/queen_inspection_form.html', array('queen' => $queen));
     }

  }
