<?php

namespace Accounted\Validation\Rules;

use Accounted\Helpers\Hash;
use Accounted\User\User;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Validator as v;

final class AccountPasswordIncorrect extends AbstractRule
{
	protected $identifier;
	/** @var \Accounted\Helpers\Hash */
	protected $hashHelper;

	public function __construct($identifier, $hashHelper)
	{
		$this->identifier = $identifier;
		$this->hashHelper = $hashHelper;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($input): bool
	{
		if(!v::identifierExists()->validate($this->identifier)) return true;

		$user = User::where('username', $this->identifier)->orWhere('email', $this->identifier)->first();
		var_dump($user);
		if(!$user) return true;

		if($this->hashHelper->passwordCheck($input, $user->password)) return false;
		
		
		return true;
	}
}