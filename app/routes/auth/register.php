<?php

use Accounted\Validation\ErrorHandler;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException as NestedValidationException;

/** @var Slim\Slim $app */
/** @var \Illuminate\Database\Eloquent\Model $app->user */
/** @var Accounted\Helpers\Hash $app->hash */

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

	#region Handeling Input
	try { v::email()->setName('Email')->assert($email); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('email', $exc->getMessages([
			'Email' => 'Email not valid'
		]));
	}

	try { v::emailExists()->assert($email); }
	catch (NestedValidationException $exc)
	{
		# if email error doesn't already exist, set this error
		if(!$errorHandler->ContainsError('email'))
			$errorHandler->AddErrorList('email', $exc->getMessages());
	}

	try { v::usernameExists()->username()->assert($username); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('username', $exc->getMessages());
	}

	try { v::password()->assert($password); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('password', $exc->getMessages());
	}

	try { v::confirmPassword($password)->assert($passwordConfirm); }
	catch (NestedValidationException $exc)
	{
		$errorHandler->AddErrorList('password_confirm', $exc->getMessages([]));
	}
	#endregion

	if(!$errorHandler->IsEmpty())
	{
		$app->flash('global', 'Please make sure you\'ve filled the form correctly.');
		$app->render('auth/register.php', [
			'errors' => $errorHandler,
			'request' => $request
		]);
		
		die();
	}
	
	$identifier = $app->randomlib->generateString(128);
	
	$user = $app->user->create([
		'email' => $email,
		'username' => $username,
		'password' => $app->hash->password($password),
		'active' => false,
		'active_hash' => $app->hash->hash($identifier)
	]);

	$app->mail->send('email/auth/registered.php', [ 'user' => $user, 'identifier' => $identifier ], function($message) use ($user) {
		$message->to($user->email);
		$message->subject('Thanks for registering');
	});

	$app->flash('global', 'You have been registered');
	$app->response->redirect($app->urlFor('home'));
	
})->name('register.post');