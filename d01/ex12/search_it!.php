#!/usr/bin/php
<?php

function	main($argc, $argv)
{
	$tmp = [];
	$i = 2;
	$data = [];
	if ($argc >= 3)
	{
		while ($i < $argc)
		{
			$tmp = explode(":", $argv[$i]);
			$data[$tmp[0]] = $tmp[1];
			++$i;
		}
		$key = $argv[1];
		echo "$data[$key]\n";
	}
}

main($argc, $argv);
?>
