<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        $validator_errors = $this->{$validator}();
        $errors = array_merge($errors, $validator_errors);
      }

      return $errors;
    }

    public function validate_name(){
      $errors = array();
      if($this->name == '' || $this->name == null){
        $errors[] = 'Nimi ei saa olla tyhjä';
      }
      if(strlen($this->name) < 3){
        $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä';
      }
      return $errors;
    }

    public function validate_picture(){
      $errors = array();
      if($this->picture != '' && $this->picture != null && !preg_match('/http/i', $this->picture)){
        $errors[] = 'Kuvan tulee olla toimiva www-osoite tai tyhjä';
      }
      return $errors;
    }

    public function validate_location(){
      $errors = array();
      if($this->location != '' && $this->location != null){
        $comma = strpos($this->location, ',');
        $lat = substr($this->location,0, $comma);
        $long = substr($this->location, $comma+1, strlen($this->location));
        if (!is_numeric($lat) || !is_numeric($long)){
          $errors[] = 'Sijainnin tule olla lat,long muodossa tai tyhjä';
        }
      }
      return $errors;
    }


  }
