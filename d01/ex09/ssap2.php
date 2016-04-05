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

function	ft_sort($a, $b)
{
	$i = 0;
	$diff = 0;
	$A = ord($a[$i]);
	$B = ord($b[$i]);
	while ($diff == 0)
	{
		$A = ord($a[$i]);
		$B = ord($b[$i]);
		if (65 <= $A && $A <= 90)
			$A += 32;
		if (65 <= $B && $B <= 90)
			$B += 32;
		if ($A != $B)
		{
			$diff++;
			break;
		}
		++$i;
	}
//	echo "$A\n";
//	echo "$B\n";
	if ((48 <= $A && $A <= 57) && (97 <= $B && $B <= 122))
		return (1);
	if ((48 <= $B && $B <= 57) && (97 <= $A && $A <= 122))
		return (-1);
	if (!((48 <= $A && $A <= 57) || (97 <= $A && $A <= 122)))
		$A += 128;
	if (!((48 <= $B && $B <= 57) || (97 <= $B && $B <= 122)))
		$B += 128;
	return ($A < $B) ? -1 : 1;
}

$i = 1;
$array = [];
$final_array = [];
while ($i < $argc)
{
	array_push($array, (string)$argv[$i]);
	$i++;
}
foreach ($array as $key => $elem)
{
	if ($key == 0)
		$final_array = ft_split($elem);
	else
		$final_array = array_merge((array)$final_array, (array)ft_split($elem));
}
usort($final_array, ft_sort);
foreach ($final_array as $elem)
{
	echo "$elem\n";
}
?>
