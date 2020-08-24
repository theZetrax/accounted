<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class PasswordException extends ValidationException
{
	protected $defaultTemplate = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Password must contain a minimum of 6 letters & characetrs'
		],
		self::MODE_NEGATIVE => [
			self::STANDARD => 'Password must not contain a minimum of 6 letters & characetrs'
		]
	];
}