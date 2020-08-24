<?php

namespace Accounted\Validation;

use Respect\Validation\Validator as v;

class Validator
{
	public function __construct()
	{
	}

	public function ValidateEmail(string $email)
	{
		return v::notEmpty()->email()->setName('email')->assert($email);
	}

	public function ValidatePassword(string $password)
	{
		// v::alnum()->
	}
}