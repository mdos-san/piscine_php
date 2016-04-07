<?php
$file = file_get_contents("/nfs/2015/m/mdos-san/http/MyWebSite/j04/private/passwd");
$tab = unserialize($file);
$ok = 0;
if ($tab == null)
	$tab = [];
foreach ($tab as $key => $elem)
{
	if ($elem[login] == $_POST[login] && $elem[passwd] == hash("whirlpool", $_POST[oldpw]) && $_POST[newpw] != "")
	{
		$ok = 1;
		$tab[$key][passwd] = hash("whirlpool", $_POST[newpw]);
		file_put_contents("/nfs/2015/m/mdos-san/http/MyWebSite/j04/private/passwd", serialize($tab));
		echo "OK\n";
	}
}
if ($ok == 0)
	echo "ERROR\n";
?>
