<?php

  class StaticController extends BaseController{

    public static function signup(){
   	  View::make('static/signup-static.html');
    }
    public static function home(){
      View::make('static/home-static.html');
    }
    public static function login(){
      View::make('static/login-static.html');
    }
    public static function reminderNew(){
      View::make('static/reminder-static/reminder-new.html');
    }


    public static function hiveEdit(){
   	  View::make('static/hive-static/hive-edit.html');
    }
    public static function hiveList(){
      View::make('static/hive-static/hive-list.html');
    }
    public static function hiveNew(){
      View::make('static/hive-static/hive-new.html');
    }
    public static function hiveShow(){
      View::make('static/hive-static/hive-show.html');
    }




    public static function apiaryEdit(){
   	  View::make('static/apiary-static/apiary-edit.html');
    }
    public static function apiaryInspectionForm(){
   	  View::make('static/apiary-static/apiary-inspection-form.html');
    }
    public static function apiaryInspection(){
      View::make('static/apiary-static/apiary-inspection.html');
    }
    public static function apiaryList(){
      View::make('static/apiary-static/apiary-list.html');
    }
    public static function apiaryNew(){
      View::make('static/apiary-static/apiary-new.html');
    }
    public static function apiaryShow(){
      View::make('static/apiary-static/apiary-show.html');
    }


    public static function queenEdit(){
   	  View::make('static/queen-static/queen-edit.html');
    }
    public static function queenInspectionForm(){
   	  View::make('static/queen-static/queen-inspection-form.html');
    }
    public static function queenInspection(){
      View::make('static/queen-static/queen-inspection.html');
    }
    public static function queenList(){
      View::make('static/queen-static/queen-list.html');
    }
    public static function queenNew(){
      View::make('static/queen-static/queen-new.html');
    }
    public static function queenShow(){
      View::make('static/queen-static/queen-show.html');
    }



    public static function inspectionList(){
      View::make('static/inspection-static/inspection-list.html');
    }
    public static function inspectionShow(){
      View::make('static/inspection-static/inspection-show.html');
    }




  }
