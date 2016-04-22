<?php

abstract class	Ship implements IVehicle{

	const	PP = 42;
	const	SIZE = 20;

	static	$id = 0;

	private	$_name;
	private	$_size;
	private	$_sprite;
	private	$_health;
	private	$_pp;
	private	$_speed;
	private	$_mobility;
	private	$_shield;
	private	$_weapon;

	private	$_dir;
	private	$_moving;

	private	$_faction;
	private	$_id;

	private	$_x;
	private	$_y;

	private	$_selected = false;
	private	$_activated = false;
	private $_done = false;

	private $_speed_pp = 0;
	private $_shield_pp = 0;
	private $_power_pp = 0;


	public function	get_name() { return($this->_name); }
	public function	get_size() { return($this->_size); }
	public function	get_sprite() { return($this->_sprite); }
	public function	get_health() { return($this->_health); }
	public function	get_pp() { return($this->_pp); }
	public function	get_speed() { return($this->_speed); }
	public function	get_mobility() { return($this->_mobility); }
	public function	get_shield() { return($this->_shield); }
	public function	get_weapon() { return($this->_weapon); }
	public function	get_dir() { return($this->_dir); }
	public function	get_moving() { return($this->_moving); }
	public function	get_faction() { return($this->_faction); }
	public function	get_id() { return($this->_id); }
	public function	get_x() { return($this->_x); }
	public function	get_y() { return($this->_y); }
	public function	get_selected() { return($this->_selected); }
	public function	get_activated() { return($this->_activated); }
	public function	get_done() { return($this->_done); }
	public function	get_speed_pp() { return($this->_speed_pp); }
	public function	get_shield_pp() { return($this->_shield_pp); }
	public function	get_power_pp() { return($this->_power_pp); }

	public function	set_name($v) { $this->_name = $v; }
	public function	set_size($v) { $this->_size = $v; }
	public function	set_sprite($v) { $this->_sprite = $v; }
	public function	set_health($v) { $this->_health = $v; }
	public function	set_pp($v) { $this->_pp = $v; }
	public function	set_speed($v) { $this->_speed = $v; }
	public function	set_mobility($v) { $this->_mobility = $v; }
	public function	set_shield($v) { $this->_shield = $v; }
	public function	set_weapon($v) { $this->_weapon = $v; }
	public function	set_dir($v) { $this->_dir = $v; }
	public function	set_moving($v) { $this->_moving = $v; }
	public function	set_faction($v) { $this->_faction = $v; }
	public function	set_id($v) { $this->_id = $v; }
	public function	set_x($v) { $this->_x = $v; }
	public function	set_y($v) { $this->_y = $v; }
	public function	set_selected($v) { $this->_selected = $v; }
	public function	set_activated($v) { $this->_activated = $v; }
	public function	set_done($v) { $this->_done = $v; }
	public function	set_speed_pp($v) { $this->_speed_pp = $v; }
	public function	set_shield_pp($v) { $this->_shield_pp = $v; }
	public function	set_power_pp($v) { $this->_power_pp = $v; }

	public function	move($x, $y) {
		if ($x == $this->get_x())	
		{
			($this->get_y() > $y) ? $this->set_dir(1) : $this->set_dir(3);
			if (abs($this->get_y() - $y) == $this->get_mobility())
			{
				$this->set_moving(false);
			}
			else
				$this->set_moving(true);
			$this->set_y($y);
		}
		else if ($y == $this->get_y())
		{
			($this->get_x() > $x) ? $this->set_dir(4) : $this->set_dir(2);
			if (abs($this->get_x() - $x) == $this->get_mobility())
			{
				$this->set_moving(false);
			}
			else
				$this->set_moving(true);
			$this->set_x($x);
		}
		else
			echo "Error";
	}

	public function display() {
		$angle = 0;
		if ($this->get_dir() == 2)
			$angle = 90;
		if ($this->get_dir() == 3)
			$angle = 180;
		if ($this->get_dir() == 4)
			$angle = 270;
		if ($this->get_selected() == true)
			$border = "2px solid Chartreuse";
		else
			$border = "";
		if ($this->get_activated())
			$border = "2px solid cyan";
		if ($this->get_done())
			$border = "2px solid DarkMagenta";
		echo "
			<a href='selection.php?id=" . $this->get_id(). "'>
			<div style='
			display: inline;
		position: absolute;
		width: " . self::SIZE . "px;
		height: " . self::SIZE . "px;
		left: " . self::SIZE * ($this->get_x())."px;
		top: " . self::SIZE * ($this->get_y())."px;
		border: ". $border .";
		'>
			<img
			style='
			max-width: 100%;
		max-height: 100%;
		transform: rotate(" . $angle . "deg);
		'
			src='". $this->get_sprite() ."'
			alt='". $this->get_faction() . $this->get_name() ."'	
			/>
			</div>
			</a>
			";
	}

	public function display_without_link() {
		$angle = 0;
		if ($this->get_dir() == 2)
			$angle = 90;
		if ($this->get_dir() == 3)
			$angle = 180;
		if ($this->get_dir() == 4)
			$angle = 270;
		if ($this->get_selected() == true)
			$border = "2px solid Chartreuse";
		else
			$border = "";
		if ($this->get_activated())
			$border = "2px solid cyan";
		if ($this->get_done())
			$border = "2px solid DarkMagenta";
		echo "
			<div style='
			display: inline;
		position: absolute;
		width: " . self::SIZE . "px;
		height: " . self::SIZE . "px;
		left: " . self::SIZE * ($this->get_x())."px;
		top: " . self::SIZE * ($this->get_y())."px;
		border: ". $border .";
		'>
			<img
			style='
			max-width: 100%;
		max-height: 100%;
		transform: rotate(" . $angle . "deg);
		'
			src='". $this->get_sprite() ."'
			alt='". $this->get_faction() . $this->get_name() ."'	
			/>
			</div>";
	}

	public	function __toString(){
		return(
			"Faction: " . $this->get_faction() . "<br/>" .
			"Name: " . $this->get_name() . "<br/>" .
			"PPs: " . $this->get_pp() . "<br/>" .
			"Health: " . $this->get_health() . "<br/>".
			"Speed: " . $this->get_speed() . "<br/>".
			"Mobility: " . $this->get_mobility() . "<br/>".
			"Speed PPs: " . $this->get_speed_pp() . "<br/>".
			"Shield PPs: " . $this->get_shield_pp() . "<br/>".
			"Power PPs: " . $this->get_power_pp() . "<br/>"
		);
	}

	public	function take_dmg(){
		if ($this->get_shield_pp() > 0)
			$this->set_shield_pp($this->get_shield_pp() - 1);
		else
			$this->set_health($this->get_health() - 1);
	}
}

?>
