<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/bootstrap.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

$validator = v::not(v::emailExists());
try
{
	$validator->assert('abebe@email.com');
} catch (NestedValidationException $exc)
{
	var_dump($exc->getMessages());
}
