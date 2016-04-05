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
?>
