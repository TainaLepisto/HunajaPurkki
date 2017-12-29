<?php

// STAATTISET SIVUSUUNNITELMAT


$routes->get('/static/signup', function() {
  StaticController::signup();
});
$routes->get('/static/home', function() {
  StaticController::home();
});
$routes->get('/static/login', function() {
  StaticController::login();
});


$routes->get('/static/reminder/new', function() {
  StaticController::reminderNew();
});


$routes->get('/static/hive/edit', function() {
  StaticController::hiveEdit();
});
$routes->get('/static/hive/list', function() {
  StaticController::hiveList();
});
$routes->get('/static/hive/new', function() {
  StaticController::hiveNew();
});
$routes->get('/static/hive/show', function() {
  StaticController::hiveShow();
});




$routes->get('/static/apiary/edit', function() {
  StaticController::apiaryEdit();
});
$routes->get('/static/apiary/inspectionForm', function() {
  StaticController::apiaryInspectionForm();
});
$routes->get('/static/apiary/inspection', function() {
  StaticController::apiaryInspection();
});
$routes->get('/static/apiary/list', function() {
  StaticController::apiaryList();
});
$routes->get('/static/apiary/new', function() {
  StaticController::apiaryNew();
});
$routes->get('/static/apiary/show', function() {
  StaticController::apiaryShow();
});



$routes->get('/static/queen/edit', function() {
  StaticController::queenEdit();
});
$routes->get('/static/queen/inspectionForm', function() {
  StaticController::queenInspectionForm();
});
$routes->get('/static/queen/inspection', function() {
  StaticController::queenInspection();
});
$routes->get('/static/queen/list', function() {
  StaticController::queenList();
});
$routes->get('/static/queen/new', function() {
  StaticController::queenNew();
});
$routes->get('/static/queen/show', function() {
  StaticController::queenShow();
});





$routes->get('/static/inspection/list', function() {
  StaticController::inspectionList();
});
$routes->get('/static/inspection/show', function() {
  StaticController::inspectionShow();
});
