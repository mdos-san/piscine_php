#!/usr/bin/php
<?php
function	ft_split($str)
{
	$array = explode(" ", $str);
	foreach ($array as $key => $elem)
	{
		if ($elem == "")
			unset($array[$key]);
	}
	sort($array);
	return $array;
}
if ($argc >= 2)
{
	$array = ft_split($argv[1]);
	$nbr = count($array);
	$tmp = $array[$nbr - 1];
	$array[$nbr - 1] = $array[0];
	$array[0] = $tmp;
	foreach ($array as $elem)
		echo "$elem ";
	echo "\n";
}
?>
