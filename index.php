<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/bootstrap.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

$passwordValidator = v::password();
$confirmPasswordValidator = v::confirmPassword('whay');
$emailValidator = v::email();

try
{
	v::accountPasswordIncorrect('emili', $app->hash)->assert('passsas1234');
} catch (NestedValidationException $exc)
{
	var_dump($exc->getMessages());
}