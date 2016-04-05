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
	return array_values($array);
}

$i = 1;
$array = [];
$final_array = [];
while ($i < $argc)
{
	array_push($array, $argv[$i]);
	$i++;
}
foreach ($array as $key => $elem)
{
	if ($key == 0)
		$final_array = ft_split($elem);
	else
		$final_array = array_merge((array)$final_array, (array)ft_split($elem));
}
sort($final_array);
foreach ($final_array as $elem)
{
	echo "$elem\n";
}
?>
