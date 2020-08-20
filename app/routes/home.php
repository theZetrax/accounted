<?php

/** @var \Slim\Slim $app */

$app->get('/', function() use ($app) {
	$app->render('home.php');
})->name('home');

$app->get('/flash', function() use ($app) {
	$app->flash('global', 'you have registered');
	$app->response->redirect($app->urlFor('home'));
});