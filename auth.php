<?php

function auth($login, $passwd)
{
	if (!file_exists("private/passwd"))
		return FALSE;
	$array = unserialize(file_get_contents("private/passwd"));
	foreach($array as $key => $elem)
	{
		if ($login == $array[$key]['login'] && hash(whirlpool, $passwd) == $array[$key]['passwd'])
			return TRUE;
	}
	return FALSE;
}

?>
