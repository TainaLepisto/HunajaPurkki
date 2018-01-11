<?php

  class StaticController extends BaseController{

    public static function signup(){
   	  View::make('static/signup_static.html');
    }
    public static function home(){
      View::make('static/home_static.html');
    }
    public static function login(){
      View::make('static/login_static.html');
    }
    public static function reminderNew(){
      View::make('static/reminder_static/reminder_new.html');
    }


    public static function hiveEdit(){
   	  View::make('static/hive_static/hive_edit.html');
    }
    public static function hiveList(){
      View::make('static/hive_static/hive_list.html');
    }
    public static function hiveNew(){
      View::make('static/hive_static/hive_new.html');
    }
    public static function hiveShow(){
      View::make('static/hive_static/hive_show.html');
    }




    public static function apiaryEdit(){
   	  View::make('static/apiary_static/apiary_edit.html');
    }
    public static function apiaryInspectionForm(){
   	  View::make('static/apiary_static/apiary_inspection_form.html');
    }
    public static function apiaryInspection(){
      View::make('static/apiary_static/apiary_inspection.html');
    }
    public static function apiaryList(){
      View::make('static/apiary_static/apiary_list.html');
    }
    public static function apiaryNew(){
      View::make('static/apiary_static/apiary_new.html');
    }
    public static function apiaryShow(){
      View::make('static/apiary_static/apiary_show.html');
    }


    public static function queenEdit(){
   	  View::make('static/queen_static/queen_edit.html');
    }
    public static function queenInspectionForm(){
   	  View::make('static/queen_static/queen_inspection_form.html');
    }
    public static function queenInspection(){
      View::make('static/queen_static/queen_inspection.html');
    }
    public static function queenList(){
      View::make('static/queen_static/queen_list.html');
    }
    public static function queenNew(){
      View::make('static/queen_static/queen_new.html');
    }
    public static function queenShow(){
      View::make('static/queen_static/queen_show.html');
    }



    public static function inspectionList(){
      View::make('static/inspection_static/inspection_list.html');
    }
    public static function inspectionShow(){
      View::make('static/inspection_static/inspection_show.html');
    }




  }
