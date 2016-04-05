#!/usr/bin/php
<?php
function	is_digit($c)
{
	$d = ord($c);
	if (48 <= $d && $d <= 57)
		return (1);
	return (0);
}
function	is_operator($c)
{
	if ($c == "+" || $c == "-" || $c == "*" || $c == "/" || $c == "%")
		return (1);
	return (0);
}
function	add($a, $b)
{
	$result = $a + $b;
	echo "$result\n";
}
function	sub($a, $b)
{
	$result = $a - $b;
	echo "$result\n";
}
function	mul($a, $b)
{
	$result = $a * $b;
	echo "$result\n";
}
function	div($a, $b)
{

	$result = $a / $b;
	echo "$result\n";
}
function	mod($a, $b)
{
	$result = $a % $b;
	echo "$result\n";
}

if ($argc == 2)
{
	$array = $argv[1];
	$i = 0;
	$count = 0;
	$op = 0;
	while ($array[$i])
	{
		if (!(is_operator($array[$i]) || is_digit($array[$i]) || $array[$i] == " ") || $count == 2)
		{
			echo "Syntax Error\n";
			return (0);
		}
		if (is_operator($array[$i]))
			++$count;
		++$i;
	}
	$i = 0;
	while ($array[$i])
	{
		if (is_operator($array[$i]))
		{
			$op = $array[$i];
			break ;
		}
		++$i;
	}
	$nbr = explode($op, $array);
	($op == "+") ? add($nbr[0], $nbr[1]): 0;
	($op == "-") ? sub($nbr[0], $nbr[1]): 0;
	($op == "*") ? mul($nbr[0], $nbr[1]): 0;
	($op == "/") ? div($nbr[0], $nbr[1]): 0;
	($op == "%") ? mod($nbr[0], $nbr[1]): 0;
}
else
	echo "Incorrect Parameters\n";
?>
