<?php

namespace Accounted\Validation\Rules;

use Accounted\User\User;
use Respect\Validation\Rules\AbstractRule;

final class EmailExists extends AbstractRule
{
	/**
	 * {@inheritdoc}
	 */
	public function validate($input): bool
	{
		$all_users = User::all();
		foreach( $all_users as $user) if($user->email === $input) return false;
		return true;
	}
}