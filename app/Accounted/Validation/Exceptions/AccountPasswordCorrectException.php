<?php

namespace Accounted\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class AccountPasswordCorrectException extends ValidationException
{
	protected $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Account Password incorrect'
		]
	];
}