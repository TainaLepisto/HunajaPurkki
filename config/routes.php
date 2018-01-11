<?php

// kurssin testireitti
$routes->get('/hiekkalaatikko', function() {
  HelloWorldController::sandbox();
});
// kannan testireitti
  $routes->get('/tietokantayhteys', function(){
    DB::test_connection();
  });



// kirjautumisen tilan tarkastajat
function check_logged_in(){
  BaseController::check_logged_in();
}

function check_need_for_login(){
  BaseController::check_need_for_login();
}


// Yleiset reitit
  $routes->get('/', 'check_need_for_login', function() {
    HelloWorldController::index();
  });

  $routes->get('/createLogin', function() {
    HelloWorldController::signup();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->post('/logout', function() {
    UserController::handle_logout();
  });

  $routes->get('/login', 'check_logged_in', function() {
    UserController::login();
  });


  $routes->get('/reminder/new', 'check_logged_in', function() {
    HelloWorldController::createReminder();
  });


// Tarhaan (HIVE) liittyvät reitit
  $routes->get('/hive', 'check_logged_in', function() {
    HiveController::listAll();
  });

  $routes->post('/hive/new', 'check_logged_in', function(){
    HiveController::saveNew();
  });

  $routes->get('/hive/new', 'check_logged_in', function(){
    HiveController::create();
  });

  $routes->get('/hive/:id', 'check_logged_in', function($id) {
    HiveController::show($id);
  });

  $routes->get('/hive/:id/edit', 'check_logged_in', function($id) {
    HiveController::edit($id);
  });

  $routes->post('/hive/:id/edit', 'check_logged_in', function($id) {
    HiveController::update($id);
  });

  $routes->post('/hive/:id/remove', 'check_logged_in', function($id) {
    HiveController::remove($id);
  });

// Pesään (APIARY) liittyvät reitit
  $routes->get('/apiary', 'check_logged_in', function() {
    ApiaryController::listAll();
  });

  $routes->get('/apiary/new/:id', 'check_logged_in', function($id){
    ApiaryController::createForHive($id);
  });

  $routes->get('/apiary/new', 'check_logged_in', function(){
    ApiaryController::create();
  });

  $routes->post('/apiary', 'check_logged_in', function(){
    ApiaryController::saveNew();
  });

  $routes->get('/apiary/:id', 'check_logged_in', function($id) {
    ApiaryController::show($id);
  });

  $routes->get('/apiary/:id/edit', 'check_logged_in', function($id) {
    ApiaryController::edit($id);
  });

  $routes->post('/apiary/:id/edit', 'check_logged_in', function($id) {
    ApiaryController::update($id);
  });

  $routes->post('/apiary/:id/remove', 'check_logged_in', function($id) {
    ApiaryController::remove($id);
  });

  $routes->get('/apiary/:id/inspection', 'check_logged_in', function($id) {
    ApiaryController::inspection($id);
  });

  $routes->get('/apiary/:id/inspectionform', 'check_logged_in', function($id) {
    ApiaryController::inspectionForm($id);
  });

// EMOON (QUEEN) liittyvät reitit
  $routes->get('/queen', 'check_logged_in', function() {
    QueenController::listAll();
  });

  $routes->get('/queen/new', 'check_logged_in', function(){
    QueenController::create();
  });

  $routes->get('/queen/1', 'check_logged_in', function() {
    QueenController::show();
  });

  $routes->get('/queen/1/edit', 'check_logged_in', function() {
    QueenController::edit();
  });

  $routes->get('/queen/1/inspection', 'check_logged_in', function() {
    QueenController::inspection();
  });

  $routes->get('/queen/1/inspectionform', 'check_logged_in', function() {
    QueenController::inspectionForm();
  });

// Tarkastuksiin (inspection) liittyvät reitit
  $routes->get('/inspection', 'check_logged_in', function() {
    InspectionController::listAll();
  });

  $routes->get('/inspection/new', 'check_logged_in', function(){
    InspectionController::create();
  });

  $routes->get('/inspection/1', 'check_logged_in', function() {
    InspectionController::show();
  });

  $routes->get('/inspection/1/edit', 'check_logged_in', function() {
    InspectionController::edit();
  });
