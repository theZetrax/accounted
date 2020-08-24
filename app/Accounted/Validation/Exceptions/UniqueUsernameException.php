<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class UniqueUsernameException extends ValidationException
{
	protected $defaultTemplate = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Username already exists.'
		],
		self::MODE_NEGATIVE => [
			self::STANDARD => 'Username doesn\'t exist.'
		]
	];
}