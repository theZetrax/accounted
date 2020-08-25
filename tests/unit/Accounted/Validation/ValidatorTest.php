<?php

use PHPUnit\Framework\TestCase;
use Accounted\Validation\Validator;
use Respect\Validation\Validator as RespectValidator;
use Respect\Validation\Factory;

class ValidatorTest extends TestCase
{
	/** @before */
	public function setup(): void
	{
		Factory::setDefaultInstance(
			(new Factory())
				->withRuleNamespace('Accounted\\Validation\\Rules')
				->withExceptionNamespace('Accounted\\Validation\\Exceptions')
		);
	}

	/** @after */
	public function cleanup()
	{}

	/** @test */
	public function can_create_validator()
	{
		$password = 'was';
		$passwordValidator = RespectValidator::password();
		
		$validator = new Validator();
		$validator->AddValidation('password', $passwordValidator, $password);
		
		$this->assertFalse($validator->IsValid('password'));
	}
}