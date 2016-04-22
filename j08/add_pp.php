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
	if ($v->get_id() == $id)
	{
		if ($_POST['button'] == "Add speed pp")
			$v->set_speed_pp($v->get_speed_pp() + 1);
		if ($_POST['button'] == "Add shield pp")
			$v->set_shield_pp($v->get_shield_pp() + 1);
		if ($_POST['button'] == "Add power pp")
			$v->set_power_pp($v->get_power_pp() + 1);
		$v->set_pp($v->get_pp() - 1);
		$_SESSION['ally'] = serialize($ally);
		header('Location: selection.php?id='.$id);
	}
}

foreach($alien as $v)
{
	if ($v->get_id() == $id)
	{
		if ($_POST['button'] == "Add speed pp")
			$v->set_speed_pp($v->get_speed_pp() + 1);
		if ($_POST['button'] == "Add shield pp")
			$v->set_shield_pp($v->get_shield_pp() + 1);
		if ($_POST['button'] == "Add power pp")
			$v->set_power_pp($v->get_power_pp() + 1);
		$v->set_pp($v->get_pp() - 1);
		$_SESSION['alien'] = serialize($alien);
		header('Location: selection.php?id='.$id);
	}
}


?>
