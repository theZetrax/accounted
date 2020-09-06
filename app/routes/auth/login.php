<?php

use Accounted\User\User;
use Accounted\Validation\ErrorHandler;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

/** @var Slim\Slim $app */
/** @var Illuminate\Database\Eloquent\Model $app->user */
/** @var \Accounted\Helpers\Hash $app->hash */

$app->get('/login', function() use ($app) {
	$app->render('auth/login.php');
})->name('login');

$app->post('/login', function() use ($app) {

	$request = $app->request();
	$errorHandler = new ErrorHandler();
	
	$identifier = $request->post('identifier');
	$password = $request->post('password');

	try { v::not(v::identifierExists())->assert($identifier); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('identifier', $exc->getMessages());
	}

	if(!$errorHandler->IsEmpty())
	{
		$app->render('auth/login.php', [
			'errors' => $errorHandler,
			'request' => $request
		]);

		die();
	}

	$user = User::where('username', $identifier)
				->where('active', true)
				->orWhere('email', $identifier)
				->first();

	if($user && $app->hash->passwordCheck($password, $user->password))
	{
		$_SESSION[$app->config->get('auth.session')] = $user->id;
		$app->flash('global', 'You have been logged in.');
	} else {
		$app->flash('global', 'Couldn\'t log you in');
	}

	$app->redirect($app->urlFor('home'));
	
})->name('login.post');