<?php

/** @var \Slim\Slim $app */

$app->get('/', function() use ($app) {
	$app->render('home.php');
})->name('home');