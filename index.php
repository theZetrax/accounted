<?php

require_once __DIR__ . '/vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Factory;

Factory::setDefaultInstance(
	(new Factory())
		->withRuleNamespace('Accounted\\Validation\\Rules')
		->withExceptionNamespace('Accounted\\Validation\\Exceptions')
);

try
{
	v::password()->assert('aaa');
} catch (NestedValidationException $exc)
{
	var_dump($exc->getMessages([
		'uppercase' => 'data must always be uppercase',
		'noWhitespace' => 'data must not contain white space'
	]));
}
