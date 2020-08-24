<?php

namespace Accounted\Validation\Rules;

use Respect\Validation\Rules;
use Respect\Validation\Rules\AbstractRule;

final class Username extends AbstractRule
{
	protected $usernameValidator;
	protected $usernameLengthValidator;
	
	public function __construct()
	{
		$this->usernameValidator = new Rules\AllOf(
			new Rules\NoWhitespace(),
			new Rules\Alnum('_'),
			new Rules\NotEmpty(),
		);

		$this->usernameLengthValidator = new Rules\AllOf(
			new Rules\Max(20),
			new Rules\Min(0)
		);
	}

	public function validate($input): bool
	{
		return $this->usernameValidator->validate($input) && $this->usernameLengthValidator->validate(strlen($input));
	}
}