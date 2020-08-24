<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class UsernameExistsException extends ValidationException
{
	protected $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Username already exists.'
		],
		self::MODE_NEGATIVE => [
			self::STANDARD => 'Username doesn\'t exist.'
		]
	];
}