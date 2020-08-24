<?php

namespace Accounted\Validation\Rules;

use Respect\Validation\Rules;
use Respect\Validation\Rules\AbstractRule;

final class Password extends AbstractRule
{
	protected $passwordValidator;
	protected $passwordLengthValidator;

	public function __construct()
	{
		$this->passwordValidator = new Rules\AllOf(
			new Rules\Alnum(),
			new Rules\NotEmpty()
		);

		$this->passwordLengthValidator = new Rules\AllOf(
			new Rules\Min(6)
		);
	}
	
	public function validate($input): bool
	{
		// Only letters and numbers
		return $this->passwordValidator->validate($input) && $this->passwordLengthValidator->validate(count($input));
	}
}