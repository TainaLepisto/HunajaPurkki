
<?php

  class ReminderController extends BaseController{

    public static function listAll(){
      $reminders = Reminder::all();
   	  View::make('/login', array('reminders' => $reminders));
    }

    public static function create(){
      $apiarys = Apiary::all();
      View::make('reminder/reminder_new.html', array('apiarys' => $apiarys));
    }

    public static function saveNew(){

      $params = $_POST;

      $attributes = array(
        'beekeeperID' => $_SESSION['user'],
        'title' => $params['title'],
        'reminderdate' => $params['reminderdate'],
        'comments' => $params['comments'],
        'linkedApiarys' => array()
      );

      // Otetaan talteen kaikki käyttäjän valitsemat pesät
      $selectedApiarys = $params['selectApiarys']
      foreach($selectedApiarys as $selectedApiary){
        // Lisätään kaikkien kategorioiden id:t taulukkoon
        $attributes['linkedApiarys'][] = $selectedApiary
      }

      $reminder = new Reminder(array($attributes));

      // tarkastetaan onko arvot sallittuja
      $errors = $reminder->errors();

      if(count($errors) == 0){
          $reminder->save();
          Redirect::to('/login', array('message' => 'Muistutus on lisätty!'));
      }else{
          $apiarys = Apiary::all();
          View::make('reminder/reminder_new.html', array('errors' => $errors, 'attributes' => $reminder, 'apiarys' => $apiarys));
      }
    }

    public static function show($id){
      $reminder = Reminder::find($id);
      View::make('reminder/reminder_show.html', array('reminder' => $reminder));
    }

    public static function remove($id){
      $reminder = new Reminder(array('reminderID' => $id));
      $reminder->remove();
      Redirect::to('/login', array('message' => 'Muistutus on poistettu onnistuneesti'));
    }
