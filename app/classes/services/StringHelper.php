<?php


namespace App\services;


class StringHelper
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
}