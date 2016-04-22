<?php

class Recon extends Ship implements IWeapon{

	const	PP = 10;

	public function __construct($faction, $x, $y){
		$this->set_name("Recon");
		$this->set_size(1);
		($faction == "ally") ? $this->set_sprite("/imgs/recon_ally.png") : $this->set_sprite("/imgs/recon_alien.jpg");
		$this->set_health(4);
		$this->set_pp(10);
		$this->set_speed(18);
		$this->set_mobility(3);
		$this->set_shield(0);
		$this->set_weapon("blaster");
		($faction == "ally") ? $this->set_dir(2) : $this->set_dir(4);
		$this->set_moving(false);
		$this->set_faction($faction);
		$this->set_x($x);
		$this->set_y($y);
		$this->set_id(parent::$id);
		parent::$id = parent::$id + 1;
		return;
	}

	public	function fire(array $target){
		echo "An attack is done";
		foreach ($target as $key => $v)
		{
			if ($this->get_x() == $v->get_x() && $this->get_y() > $v->get_y() && $this->get_dir() == 1)
				$v->take_dmg();
			if ($this->get_y() == $v->get_y() && $this->get_x() < $v->get_x()  && $this->get_dir() == 2)
				$v->take_dmg();
			if ($this->get_x() == $v->get_x() && $this->get_y() < $v->get_y()  && $this->get_dir() == 3)
				$v->take_dmg();
			if ($this->get_y() == $v->get_y() && $this->get_x() > $v->get_x()  && $this->get_dir() == 4)
				$v->take_dmg();
		}
		return;
	}
}
?>
