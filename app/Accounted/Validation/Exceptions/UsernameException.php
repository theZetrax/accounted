<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class UsernameException extends ValidationException
{
	protected $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Username is a maximum of 20 characters containing letters, numbers and a dash.'
		],
		self::MODE_NEGATIVE => [
			self::STANDARD => 'Username must not be a maximum of 20 characters containing letters, numbers and a dash.'
		]
	];
}