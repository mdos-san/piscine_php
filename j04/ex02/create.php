<?php
$exist = 0;
file_put_contents("/nfs/2015/m/mdos-san/http/MyWebSite/j04/private/passwd", FILE_APPEND);
$file = file_get_contents("/nfs/2015/m/mdos-san/http/MyWebSite/j04/private/passwd");
$tab = unserialize($file);
if ($tab == null)
	$tab = [];
foreach ($tab as $elem)
{
	if ($elem[login] == $_POST[login])
	{
		$exist = 1;
		echo "ERROR\n";
	}

}
if ($exist == 0)
{
	array_push($tab, array("login" => $_POST[login], "passwd" => hash("whirlpool", $_POST[passwd])));
	file_put_contents("/nfs/2015/m/mdos-san/http/MyWebSite/j04/private/passwd", serialize($tab));
	echo "OK\n";
}
?>
