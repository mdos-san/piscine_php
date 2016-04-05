#!/usr/bin/php
<?php
if ($argc == 2)
{
	function	ft_split($str)
	{
		$array = explode(" ", $str);
		foreach ($array as $key => $elem)
		{
			if ($elem == "")
				unset($array[$key]);
		}
		return array_values($array);
	}
	$array = ft_split($argv[1]);
	$str = "";
	foreach ($array as $elem)
		$str = $str." ".$elem;
	$str = trim($str, " ");
	echo "$str\n";
}
?>
