#!/usr/bin/php
<?php
if ($argc == 4)
{
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
	$array = array(trim($argv[1], " "), trim($argv[2], " "), trim($argv[3], " "));
	($array[1] == "+") ? add($array[0], $array[2]): 0;
	($array[1] == "-") ? sub($array[0], $array[2]): 0;
	($array[1] == "*") ? mul($array[0], $array[2]): 0;
	($array[1] == "/") ? div($array[0], $array[2]): 0;
	($array[1] == "%") ? mod($array[0], $array[2]): 0;
}
else
	echo "Incorrect Parameters\n";

?>
