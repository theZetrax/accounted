<?php

namespace Accounted\Validation\Rules;

use Accounted\User\User;
use Respect\Validation\Rules\AbstractRule;

final class UniqueUsername extends AbstractRule
{
	public function validate($input): bool
	{
		$users = User::all();
		
		foreach($users as $user)
			if($user->username === $input) return false;
		
		return true;
	}
}