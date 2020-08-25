<?php

namespace Accounted\Validation\Rules;

use Accounted\User\User;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Rules\AbstractRules;

final class AccountPasswordCorrect extends AbstractRule
{
	protected $username;

	public function __construct($username)
	{
		$this->username = $username;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($input): bool
	{
		$user = User::where('username', $this->username)->where('password', $input)->get();
		if(count($user) > 0) return true;
		return false;
	}
}