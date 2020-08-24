<?php

use Accounted\Validation\ErrorHandler;
use PHPUnit\Framework\TestCase;

/** @covers Accounted\Validation\ErrorHandler */
class ErrorHandlerTest extends TestCase
{
	/** @var ErrorHandler $errorHandler */
	protected $errorHandler;
	
	/** @before */
	public function setup(): void
	{
		$this->errorHandler = new ErrorHandler;
	}

	/** @before */
	public function cleanup()
	{
		$this->errorHandler = null;
	}

	/** @test */
	public function can_create_error_list_with_array()
	{
		$errorList = [
			'email' => [
				'alnum' => 'email is not all numeric',
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'equals' => 'email is not the same as password'
			]
		];

		$this->errorHandler = new ErrorHandler($errorList);

		$this->assertEquals($errorList['email'], $this->errorHandler->GetError('email'));
	}

	/** @test */
	public function can_add_error()
	{
		$errorList = [
			'email' => [
				'alnum' => 'email is not all numeric',
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'equals' => 'email is not the same as password'
			],
			'password' => [
				'alnum' => 'email is not all numeric',
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'equals' => 'email is not the same as password'
			]
		];

		$this->errorHandler->AddErrors($errorList);

		$this->assertContains('email', array_keys($this->errorHandler->GetErrors()));
		$this->assertContains('password', array_keys($this->errorHandler->GetErrors()));
		$this->assertEquals($errorList['email'], $this->errorHandler->GetError('email'));
		$this->assertEquals($errorList['password'], $this->errorHandler->GetError('password'));
	}

	/** @test */
	public function can_check_if_contains_error()
	{
		$errorList = [
			'email' => [
				'alnum' => 'email is not all numeric',
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'equals' => 'email is not the same as password'
			],
			'password' => [
				'alnum' => 'email is not all numeric',
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'equals' => 'email is not the same as password'
			]
		];

		$this->errorHandler->AddErrors($errorList);

		$this->assertTrue($this->errorHandler->ContainsError('email'));
		$this->assertTrue($this->errorHandler->ContainsError('password'));
	}

	/** @test */
	public function can_get_first_error_of_an_error_list()
	{
		$errorList = [
			'email' => [
				'alnum' => 'email is not all numeric',
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'equals' => 'email is not the same as password'
			],
			'password' => [
				'notEmpty' => 'email must not be empty',
				'email' => 'email is not a valid email',
				'alnum' => 'email is not all numeric',
				'equals' => 'email is not the same as password'
			]
		];

		$this->errorHandler->AddErrors($errorList);

		$this->assertEquals(array_values($errorList['email'])[0], $this->errorHandler->First('email'));
		$this->assertEquals(array_values($errorList['password'])[0], $this->errorHandler->First('password'));
	}
}