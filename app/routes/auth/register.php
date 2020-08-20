<?php

/** @var Slim\Slim $app */
/** @var \Illuminate\Database\Eloquent\Model $app->user */

$app->get('/register', function() use ($app) {
	$app->render('auth/register.php');
})->name('register');

$app->post('/register', function() use ($app) {

	$request = $app->request();

	$email = $request->post('email');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('passwordConfirm');

	$app->user->create([
		'email' => $email,
		'username' => $username,
		'password' => $password
	]);

	$app->flash('global', 'You have been registered');
	$app->response->redirect($app->urlFor('home'));
	
})->name('register.post');