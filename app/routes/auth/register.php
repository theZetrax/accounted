<?php

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException as NestedValidationException;

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

	try { v::notEmpty()->email()->setName('email')->assert($email); }
	catch (NestedValidationException $exc)
	{
		var_dump($exc->getMessages([
			'alnum' => '{{name}} is not all numeric',
			'notEmpty' => '{{name}} must not be empty',
			'email' => '{{name}} is not a valid email',
			'equals' => '{{name}} is not the same as password'
		]));
		
	}

	try	{ v::alnum('_')->notEmpty()->max(20)->setName('username')->assert($username); } 
	catch (NestedValidationException $exc)
	{
		var_dump($exc->getMessages([
			'alnum' => '{{name}} is not all numeric',
			'notEmpty' => '{{name}} must not be empty',
			'email' => '{{name}} is not a valid email',
			'equals' => '{{name}} is not the same as password'
		]));

	}

	try	{ v::alnum()->notEmpty()->min('6')->setName('password')->assert($password); }
	catch (NestedValidationException $exc)
	{
		var_dump($exc->getMessages([
			'alnum' => '{{name}} is not all numeric',
			'notEmpty' => '{{name}} must not be empty',
			'email' => '{{name}} is not a valid email',
			'equals' => '{{name}} is not the same as password'
		]));

	}

	try	{ v::alnum()->equals($password)->setName('confirmed password')->assert($passwordConfirm); }
	catch (NestedValidationException $exc)
	{
		var_dump($exc->getMessages([
			'alnum' => '{{name}} is not all numeric',
			'notEmpty' => '{{name}} must not be empty',
			'email' => '{{name}} is not a valid email',
			'equals' => '{{name}} is not the same as password'
		]));

	}
	
	die();
	
	$app->user->create([
		'email' => $email,
		'username' => $username,
		'password' => $password
	]);

	$app->flash('global', 'You have been registered');
	$app->response->redirect($app->urlFor('home'));
	
})->name('register.post');