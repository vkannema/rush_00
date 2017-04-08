<?php

session_start();

function auth($login, $passwd)
{
	if (!file_exists("private/passwd"))
		return FALSE;
	$array = unserialize(file_get_contents("private/passwd"));
	foreach($array as $key => $elem)
	{
		if ($login == $array[$key]['login'] && hash(whirlpool, $passwd) == $array[$key]['passwd'])
		{
			$_SESSION['admin'] = $array[$key]['admin'];
			return TRUE;
		}
	}
	return FALSE;
}

?>
