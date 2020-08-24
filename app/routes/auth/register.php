<?php

use Accounted\Validation\ErrorHandler;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException as NestedValidationException;

/** @var Slim\Slim $app */
/** @var \Illuminate\Database\Eloquent\Model $app->user */

$app->get('/register', function() use ($app) {
	$app->render('auth/register.php');
})->name('register');

$app->post('/register', function() use ($app) {

	$request = $app->request();
	$errorHandler = new ErrorHandler();

	$email = $request->post('email');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	try { v::notEmpty()->email()->setName('email')->assert($email); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('email', $exc->getMessages([
			'notEmpty' => '{{name}} must not be empty',
			'email' => '{{name}} is not a valid email'
		]));
	}

	try	{ v::alnum('_')->notEmpty()->max(20)->setName('username')->assert($username); } 
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('username', $exc->getMessages([
			'alnum' => '{{name}} is must be all numeric containing only dashes.',
			'notEmpty' => '{{name}} must not be empty',
			'max' => '{{name}} is more than 20 characters long'
		]));
	}

	try	{ v::alnum()->min('6')->notEmpty()->setName('password')->assert($password); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('password', $exc->getMessages([
			'notEmpty' => '{{name}} can\'t be empty',
			'min' => '{{name}} must be at least 6 characters long.'
		]));
	}

	try	{ v::equals($password)->setName('confirmed password')->assert($passwordConfirm); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('confirm_password', $exc->getMessages());
	}
	
	if(!$errorHandler->IsEmpty())
	{
		$app->render('auth/register.php', [
			'errors' => $errorHandler,
			'request' => $request
		]);
		
		die();
	}
	
	$app->user->create([
		'email' => $email,
		'username' => $username,
		'password' => $password
	]);

	$app->flash('global', 'You have been registered');
	$app->response->redirect($app->urlFor('home'));
	
})->name('register.post');