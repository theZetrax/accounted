<?php

use Accounted\User\User;
use Accounted\Validation\ErrorHandler;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

/** @var Slim\Slim $app */
/** @var Illuminate\Database\Eloquent\Model $app->user */

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
				->orWhere('email', $identifier)
				->first();
	
})->name('login.post');