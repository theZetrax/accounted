<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class IdentifierExistsException extends ValidationException
{
	protected $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Username or Email already exists.'
		],
		self::MODE_NEGATIVE => [
			self::STANDARD => 'Username or Email doesn\'t Exist.'
		]
	];
}