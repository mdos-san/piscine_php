<?php
require_once('IVehicle.class.php');
require_once('IWeapon.class.php');
require_once('Ship.class.php');
require_once('Recon.class.php');

session_start();
extract($_SESSION);
$ally = unserialize($ally);
$alien = unserialize($alien);

foreach($ally as $v)
{
	if ($v->get_activated() == true)
	{
		$ship = $v;
		$_SESSION['move'] -= ($_GET['x'] == $v->get_x() ) ? abs($v->get_y() - $_GET['y']) : abs($v->get_x() - $_GET['x']);
		$ship->move($_GET['x'], $_GET['y']);
		$_SESSION['ally'] = serialize($ally);
		header('Location: movement.php');
	}
}

foreach($alien as $v)
{
	if ($v->get_activated() == true)
	{
		$ship = $v;
		$_SESSION['move'] -= ($_GET['x'] == $v->get_x() ) ? abs($v->get_y() - $_GET['y']) : abs($v->get_x() - $_GET['x']);
		$ship->move($_GET['x'], $_GET['y']);
		$_SESSION['alien'] = serialize($alien);
		header('Location: movement.php');
	}
}
?>
