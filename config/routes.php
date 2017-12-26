<?php

// Yleiset reitit
  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/createLogin', function() {
    HelloWorldController::signup();
  });

  $routes->get('/reminder/new', function() {
    HelloWorldController::createReminder();
  });


// Tarhaan (HIVE) liittyvät reitit
  $routes->get('/hive', function() {
    HiveController::listAll();
  });

  $routes->get('/hive/new', function(){
    HiveController::create();
  });

// TODO: kaikki nää kovakoodatut 1 arvot -> $id
  //$routes->get('/hive/:id', function($id) {
  //  HiveController::show($id);
  //});

  $routes->get('/hive/1', function() {
    HiveController::show();
  });

  $routes->get('/hive/1/edit', function() {
    HiveController::edit();
  });


// Pesään (APIARY) liittyvät reitit
  $routes->get('/apiary', function() {
    ApiaryController::listAll();
  });

  $routes->get('/apiary/new', function(){
    ApiaryController::create();
  });

  $routes->get('/apiary/1', function() {
    ApiaryController::show();
  });

  $routes->get('/apiary/1/edit', function() {
    ApiaryController::edit();
  });

  $routes->get('/apiary/1/inspection', function() {
    ApiaryController::inspection();
  });

  $routes->get('/apiary/1/inspectionform', function() {
    ApiaryController::inspectionForm();
  });

// EMOON (QUEEN) liittyvät reitit
  $routes->get('/queen', function() {
    QueenController::listAll();
  });

  $routes->get('/queen/new', function(){
    QueenController::create();
  });

  $routes->get('/queen/1', function() {
    QueenController::show();
  });

  $routes->get('/queen/1/edit', function() {
    QueenController::edit();
  });

  $routes->get('/queen/1/inspection', function() {
    QueenController::inspection();
  });

  $routes->get('/queen/1/inspectionform', function() {
    QueenController::inspectionForm();
  });

// Tarkastuksiin (inspection) liittyvät reitit
  $routes->get('/inspection', function() {
    InspectionController::listAll();
  });

  $routes->get('/inspection/new', function(){
    InspectionController::create();
  });

  $routes->get('/inspection/1', function() {
    InspectionController::show();
  });

  $routes->get('/inspection/1/edit', function() {
    InspectionController::edit();
  });
