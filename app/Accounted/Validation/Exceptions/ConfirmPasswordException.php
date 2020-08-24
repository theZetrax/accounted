<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class ConfirmPasswordException extends ValidationException
{
	protected $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Confirmed password not the same as password.'
		]
	];
}