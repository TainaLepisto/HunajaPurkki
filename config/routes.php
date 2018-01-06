<?php

// Yleiset reitit
  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->get('/login', function() {
    UserController::login();
  });

  $routes->get('/createLogin', function() {
    HelloWorldController::signup();
  });

  $routes->get('/reminder/new', function() {
    HelloWorldController::createReminder();
  });

// kannan testireitti
  $routes->get('/tietokantayhteys', function(){
    DB::test_connection();
  });

// Tarhaan (HIVE) liittyvät reitit
  $routes->get('/hive', function() {
    HiveController::listAll();
  });

  $routes->post('/hive/new', function(){
    HiveController::saveNew();
  });

  $routes->get('/hive/new', function(){
    HiveController::create();
  });

  $routes->get('/hive/:id', function($id) {
    HiveController::show($id);
  });

  $routes->get('/hive/:id/edit', function($id) {
    HiveController::edit($id);
  });

  $routes->post('/hive/:id/edit', function($id) {
    HiveController::update($id);
  });

  $routes->post('/hive/:id/remove', function($id) {
    HiveController::remove($id);
  });

// Pesään (APIARY) liittyvät reitit
  $routes->get('/apiary', function() {
    ApiaryController::listAll();
  });

  $routes->get('/apiary/new/:id', function($id){
    ApiaryController::createForHive($id);
  });

  $routes->get('/apiary/new', function(){
    ApiaryController::create();
  });

  $routes->post('/apiary', function(){
    ApiaryController::saveNew();
  });

  $routes->get('/apiary/:id', function($id) {
    ApiaryController::show($id);
  });

  $routes->get('/apiary/:id/edit', function($id) {
    ApiaryController::edit($id);
  });

  $routes->post('/apiary/:id/edit', function($id) {
    ApiaryController::update($id);
  });

  $routes->post('/apiary/:id/remove', function($id) {
    ApiaryController::remove($id);
  });

  $routes->get('/apiary/:id/inspection', function($id) {
    ApiaryController::inspection($id);
  });

  $routes->get('/apiary/:id/inspectionform', function($id) {
    ApiaryController::inspectionForm($id);
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
