<?php


namespace App\services;


class FormValidation
{

	public static function sanitize($field, $specialChars = false)
	{

		if ($specialChars) {
			$field = htmlspecialchars($field);
		} else {
			$field = strip_tags($field);
		}
		$field = stripslashes($field);
		$field = trim($field);
		return $field;
	}

	public static function checkLength($field, $length)
	{
		$fieldLength = strlen($field);
		return $fieldLength >= $length;
	}

	public static function checkIfFieldsFilled($fields)
	{
		$filled = 0;
		foreach ($fields as $field) {
			if (!empty($field)) {
				$filled++;
			}
		}
		return $filled === count($fields);
	}

	public static function checkEmail($email): bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}