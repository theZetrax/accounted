<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/bootstrap.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Factory;
use Illuminate\Database\Capsule\Manager as Capsule;

Factory::setDefaultInstance(
	(new Factory())
		->withRuleNamespace('Accounted\\Validation\\Rules')
		->withExceptionNamespace('Accounted\\Validation\\Exceptions')
);

try
{
	v::not(v::usernameExists())->assert('abesbe');
} catch (NestedValidationException $exc)
{
	var_dump($exc->getMessages());
}
