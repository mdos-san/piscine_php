<div style="
	display: block;
	width: 3000px;
	height: 2000px;
	margin-top: -10;
	margin-left: -10;
	background-color: black;" >
</div>
<?php
require_once('IWeapon.class.php');
require_once('IVehicle.class.php');
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
		$v->set_activated(true);
		header('Location: selection.php?id=' . $v->get_id());
	}
}

$_SESSION['ally'] = serialize($ally);
foreach($alien as $v)
{
	if ($v->get_id() == $id)
	{
		$v->set_activated(true);
		header('Location: selection.php?id=' . $v->get_id());
	}
}
$_SESSION['alien'] = serialize($alien);
?>
