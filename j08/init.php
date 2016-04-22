<?php
require_once('IVehicle.class.php');
require_once('IWeapon.class.php');
require_once('Ship.class.php');
require_once('Recon.class.php');
echo "Destroy previous Session if exist<br>";
if (isset($_SESSION))
	session_destroy();
echo "Create new session<br>";
session_start();
$ally = [];
array_push($ally, new Recon("ally", 1, 1));
array_push($ally, new Recon("ally", 5, 10));
$alien = [];
array_push($alien, new Recon("alien", 42, 42));
array_push($alien, new Recon("alien", 30, 42));
foreach ($ally as $v)
{
echo "Create new ally " . $v->get_name() . " ship.<br>";
}
foreach ($alien as $v)
{
echo "Create new alien " . $v->get_name() . " ship.<br>";
}
$_SESSION['ally'] = serialize($ally);
$_SESSION['alien'] = serialize($alien);
$_SESSION['turn'] = 0;
$_SESSION['move'] = -1;
echo "Go on info.php to start playing! :)";
?>
