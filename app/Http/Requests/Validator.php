<?php

use Auth;

$validator->extend(
	'auth_password', function($attribute, $value, $paramters)
	{
		if (!Auth::check())
		{
			return false;
		}
		return \Hash::check($value, Auth::user()->password;
	}
);