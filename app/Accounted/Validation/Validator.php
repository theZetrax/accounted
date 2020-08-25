<?php

namespace Accounted\Validation;

use Accounted\Validation\ErrorHandler;
use Respect\Validation\Validator as RespectValidator;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
	public const VALIDATION_NAME = 'name';
	public const VALIDATION_VALIDATOR = 'validator';
	public const VALIDATION_DATA = 'data';
	public const VALIDATION_VALID = 'valid';

	protected $validations = [];
	/** @var \Accounted\Validation\ErrorHandler */
	protected $errorHandler;

	public function __construct()
	{
		$errorHandler = new ErrorHandler();
	}

	public function AddValidation(string $validationName, RespectValidator $validator, $input)
	{
		$this->validations[] = [
			self::VALIDATION_NAME => $validationName,
			self::VALIDATION_VALIDATOR => $validator,
			self::VALIDATION_DATA => $input,
			self::VALIDATION_VALID => false
		];
	}

	public function Execute()
	{
		foreach( $this->validations as $validation )
		{
			$this->Validate($validation);
		}
	}

	/**
	 * @param string $key The validation name we want to check if valid.
	 */
	public function IsValid(string $key)
	{
		$validation = $this->GetValidation($key);
		if(!$validation) return null;

		try
		{
			$validation[self::VALIDATION_VALIDATOR]->assert($validation[self::VALIDATION_DATA]);
		} catch (NestedValidationException $exc)
		{
			$this->errorHandler->AddErrorList($validation[self::VALIDATION_NAME], $exc->getMessages());
			return false;
		}

		return true;
	}

	public function GetErrorHandler()
	{
		if(!$this->errorHandler->IsEmpty())
			return $this->errorHandler;
	}

	#region [Internal]
	/**
	 * @param string $key The validation name we want to check if valid.
	 */
	protected function GetValidation(string $key)
	{
		foreach( $this->validations as $validation )
			if( $validation[self::VALIDATION_NAME] === $key ) return $validation;
		return false;
	}
	protected function Validate(array $validation)
	{
		try
		{
			$validation[self::VALIDATION_VALIDATOR]->assert($validation[self::VALIDATION_DATA]);
		} catch (NestedValidationException $exc)
		{
			$this->errorHandler->AddErrorList($validation[self::VALIDATION_NAME], $exc->getMessages());
			$validation[self::VALIDATION_VALID] = false;
			return false;
		}
		
		$validation[self::VALIDATION_VALID] = true;
		return true;
	}
	#endregion
}