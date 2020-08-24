<?php

/** @var Slim\Slim $app */
/** @var Illuminate\Database\Eloquent\Model $app->user */

$app->get('/', function() use ($app) {
	$app->render('auth/login.php');
})->name('login');

$app->post('/', function() use ($app) {
	$$request = $app->request();
})->name('login.post');