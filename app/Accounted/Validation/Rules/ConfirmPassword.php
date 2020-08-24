<?php

namespace Accounted\Validation\Rules;

use Respect\Validation\Validator as v;
use Respect\Validation\Rules\AbstractRule;

final class ConfirmPassword extends AbstractRule
{
	private $expectedPassword;

	public function __construct($expectedPassword)
	{
		$this->expectedPassword = $expectedPassword;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function validate($confirmationPassword): bool
	{
		return v::equals($this->expectedPassword)->validate($confirmationPassword);
	}
}