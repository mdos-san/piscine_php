<?php
require_once('IVehicle.class.php');
require_once('IWeapon.class.php');
require_once('Ship.class.php');
require_once('Recon.class.php');

session_start();
extract($_SESSION);
$ally = unserialize($ally);
$alien = unserialize($alien);

$ship = "";

foreach($ally as $v)
{
	if ($v->get_activated() == true && $ship == "")
	{
		$ship = $v;
		$i = 0;
		$ship->fire(($ship->get_faction() == "ally") ? $alien : $ally);
		while ($i < $ship->get_power_pp())
		{
			if (rand(1, 6) == 6)
			{
				$ship->fire(($ship->get_faction() == "ally") ? $alien : $ally);
			}
			$i++;
		}
	}
}

$ship = "";

foreach($alien as $v)
{
	if ($v->get_activated() == true && $ship == "")
	{
		$ship = $v;
		$i = 0;
		$ship->fire(($ship->get_faction() == "ally") ? $alien : $ally);
		while ($i < $ship->get_power_pp())
		{
			if (rand(1, 6) >= 5)
			{
				$ship->fire(($ship->get_faction() == "ally") ? $alien : $ally);
			}
			$i++;
		}

	}
}
$_SESSION['alien'] = serialize($alien);
$_SESSION['ally'] = serialize($ally);
header('Location: done.php');


?>
