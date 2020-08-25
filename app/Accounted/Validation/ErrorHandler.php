<?php

namespace Accounted\Validation;

use Slim\Helper\Set;

class ErrorHandler
{
	/** @var array $errors */
	protected $errors = [];
	
	public function __construct(array $errorList = null)
	{
		if(!is_null($errorList))
			foreach ($errorList as $name => $errors)
				$this->AddErrorList($name, $errors);
	}

	/**
	 * Adds an an array of errors of $errorname with $errorList array
	 * 
	 * @param array $errorList
	 * @return void
	 */
	public function AddErrors(array $errorList)
	{
		foreach ($errorList as $name => $errors)
			$this->AddErrorList($name, $errors);
	}
	public function AddErrorList(string $key, array $errorList)
	{
		
		$this->errors[$key] = $errorList;
		return true;
	}
	public function GetError(string $key)
	{
		foreach( $this->errors as $errorKey => $errorList )
			if($errorKey === $key) return $errorList;
		return false;
	}
	public function GetErrors(): array
	{
		return $this->errors;
	}
	public function ContainsError(string $key)
	{
		foreach( array_keys($this->errors) as $errorKey )
			if($errorKey === $key) return true;
		return false;
	}
	public function IsEmpty()
	{
		return count($this->errors) === 0;
	}
	public function First(string $key)
	{
		if(!$this->ContainsError($key)) return false;
		return array_values($this->GetError($key))[0];
	}
	public function Clear()
	{
		$this->errors = [];
	}

	#region [Internal]
	protected static function CheckInputFormat(array $input)
	{
		$check = is_array($input[array_key_first($input)]);
		if(!$check) return false;
	}
	protected static function CheckErrorList(array $errorList)
	{
		foreach( $errorList as $index => $list ) {
			if(!($index instanceof string)) return false;
			if(!self::CheckInputFormat($list)) return false;
		}
		return true;
	}
	#endregion
}