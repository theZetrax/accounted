<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\AbstractRule;

final class EmailExistsException extends ValidationException
{
	protected $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Email already exists.'
		],
		self::MODE_NEGATIVE => [
			self::STANDARD => 'Email doesn\'t exist.'
		]
	];
}
