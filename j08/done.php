<?php
require_once('IVehicle.class.php');
require_once('IWeapon.class.php');
require_once('Ship.class.php');
require_once('Recon.class.php');

session_start();
extract($_SESSION);
$ally = unserialize($ally);
$alien = unserialize($alien);

foreach($ally as $key => $v)
{
	if ($v->get_health() <= 0)
		unset($ally[$key]);
}

foreach($alien as $key => $v)
{
	if ($v->get_health() <= 0)
		unset($alien[$key]);
}

foreach($ally as $v)
{
	if ($v->get_activated() == true)
	{
		$ship = $v;
		$ship->set_activated(false);
		$ship->set_done(true);
		$_SESSION['move'] = -1;
		header('Location: selection.php?id='.$ship->get_id());
	}
}

foreach($alien as $v)
{
	if ($v->get_activated() == true)
	{
		$ship = $v;
		$ship->set_activated(false);
		$ship->set_done(true);
		$_SESSION['move'] = -1;
		header('Location: selection.php?id='.$ship->get_id());
	}
}

$_SESSION['ally'] = serialize($ally);
$_SESSION['alien'] = serialize($alien);
$_SESSION['turn']++;


?>

