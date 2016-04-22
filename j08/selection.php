<div style="
	display: block;
	width: 3000px;
	height: 2000px;
	margin-top: -10px;
	margin-left: -10px;
	background-color: black;" >
</div>
<?php
require_once('IVehicle.class.php');
require_once('IWeapon.class.php');
require_once('Ship.class.php');
require_once('Recon.class.php');

session_start();
extract($_SESSION);
if ($turn % 2 == 0)
	echo "Human turn<br>";
else
	echo "Alien turn<br>";
$ally = unserialize($ally);
$alien = unserialize($alien);

$order = false;
$cheat = 42;

$nb_ship = count($ally);
$nb_ship += count($alien);

$ship_done = 0;

foreach($ally as $v)
{
	if ($v->get_id() == $_GET['id'])
	{
		$v->set_selected(true);
		$faction = $v->get_faction();
		$_SESSION['id'] = $v->get_id();
		$done = $v->get_done();
		echo $v;
		$cheat = 0;
	}
	if ($v->get_activated() == true)
	{
		$order = true;
		$id_play = $v->get_id();
		$pp = $v->get_pp();
	}
	if ($v->get_done() == true)
		$ship_done++;
}

foreach($alien as $v)
{
	if ($v->get_id() == $_GET['id'])
	{
		$v->set_selected(true);
		$faction = $v->get_faction();
		echo $v;
		$_SESSION['id'] = $v->get_id();
		$done = $v->get_done();
		$cheat = 0;
	}
	if ($v->get_activated() == true)
	{
		$order = true;
		$id_play = $v->get_id();
		$pp = $v->get_pp();
	}
	if ($v->get_done() == true)
		$ship_done++;
}
if ($cheat == 42)
	die;

if ($nb_ship == $ship_done)
{
	foreach($ally as $v)
	{
		$v->set_done(false);
		$v->set_selected(false);
		$v->set_speed_pp(0);
		$v->set_shield_pp(0);
		$v->set_power_pp(0);
		$v->set_pp($v::PP);
	}
	foreach($alien as $v)
	{
		$v->set_done(false);
		$v->set_selected(false);
		$v->set_speed_pp(0);
		$v->set_shield_pp(0);
		$v->set_power_pp(0);
		$v->set_pp($v::PP);
	}
	$_SESSION['ally'] = serialize($ally);
	$_SESSION['alien'] = serialize($alien);
}

foreach($ally as $v)
	$v->display();
foreach($alien as $v)
	$v->display();
if ($order == false && $done == false)
{
	if ($faction == "ally" && $turn % 2 == 0 || $faction == "alien" && $turn % 2 == 1)
	{
		echo "
			<form action='activated.php'>
				<input type='submit' value='Activate this ship !'></input>
			</form>
			";
	}
}
else if ($order == true && $id_play == $_GET['id'] && $pp > 0)
{
	echo "
	<form method='post' action='add_pp.php'>
		<input type='submit' name='button' value='Add speed pp'></input>
		<input type='submit' name='button' value='Add shield pp'></input>
		<input type='submit' name='button' value='Add power pp'></input>
	</form>
	";
}
else if ($order == true && $id_play == $_GET['id'] && $pp <= 0)
{
	echo "
	<form method='post' action='movement.php'>
		<input type='submit' name='button' value='Start moving'></input>
	</form>
		";
}
else if ($faction == "ally" && $turn % 2 == 0 || $faction == "alien" && $turn % 2 == 1 )
echo "
<form method='post' action='done.php'>
	<input type='submit' name='button' value='Next turn!'></input>
</form>";

?>
