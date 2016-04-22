<div style="
	display: block;
	width: 3000px;
	height: 2000px;
	margin-top: -10;
	margin-left: -10;
	background-color: black;" >
</div>
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
		$ship = $v;
}

foreach($alien as $v)
{
	if ($v->get_activated() == true)
		$ship = $v;
}
if ($_SESSION['move'] == -1)
{
	$_SESSION['move'] = $ship->get_speed();
	$i = 0;
	while ($i < $ship->get_speed_pp())
	{
		$_SESSION['move'] += rand(1, 6);
		$i++;
	}
}
$i = 0;
while ($i < 100 && $_SESSION['move'] != 0)
{
	$j = 0;
	while ($j < 150)
	{
		if (abs($i - $ship->get_y()) +  abs($j - $ship->get_x()) <= $_SESSION['move'])	
		{
			if (abs($i - $ship->get_y()) == 0 || abs($j - $ship->get_x()) == 0)
				$color = "green";
			else
				$color = "yellow";
			if ($color == "green")
				echo "
					<a href='move.php?x=".$j."&y=".$i."'>
					<div style='
					display: inline;
					position: absolute;
					width: " . Ship::SIZE . "px;
					height: " . Ship::SIZE . "px;
					left: " . Ship::SIZE * ($j)."px;
					top: " . Ship::SIZE * ($i)."px;
					background-color: ". $color .";'></div></a>";
			else
				echo "
					<div style='
					display: inline;
					position: absolute;
					width: " . Ship::SIZE . "px;
					height: " . Ship::SIZE . "px;
					left: " . Ship::SIZE * ($j)."px;
					top: " . Ship::SIZE * ($i)."px;
					background-color: ". $color .";'></div>";

		}
		$j++;
	}
	$i++;
}
foreach($ally as $v)
	$v->display_without_link();
foreach($alien as $v)
	$v->display_without_link();
echo "
	<form method='post' action='done.php'>
		<input type='submit' name='done' value='End of turn!'></input>
	</form>
	<form method='post' action='attack.php'>
		<input type='submit' name='done' value='Attack!'></input>
	</form>
	";
?>
