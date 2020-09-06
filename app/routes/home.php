<?php

/** @var \Slim\Slim $app */
/** @var \RandomLib\Generator $app->randomlib */

$app->get('/', function() use ($app) {
	$app->render('home.php');
})->name('home');