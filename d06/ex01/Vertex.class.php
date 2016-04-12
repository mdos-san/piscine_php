<?php

require_once('Color.class.php');

class	Vertex{

	static	$verbose = false;

	private	$_x;
	private	$_y;
	private	$_z;
	private	$_w;
	private	$_color;

	public function	get_x() { return ($this->_x); }
	public function	get_y() { return ($this->_y); }
	public function	get_z() { return ($this->_z); }
	public function	get_w() { return ($this->_w); }
	public function	get_color() { return ($this->_color); }

	public function set_x($v) { $this->_x = $v; }
	public function set_y($v) { $this->_y = $v; }
	public function set_z($v) { $this->_z = $v; }
	public function set_w($v) { $this->_w = $v; }
	public function set_color($v) { $this->_color = $v; }

	public function	__construct(array $kwarg){
		$this->_x = $kwarg['x'];
		$this->_y = $kwarg['y'];
		$this->_z = $kwarg['z'];
		if (array_key_exists('w', $kwarg))
			$this->_w = $kwarg['w'];
		else
			$this->_w = 1.0;
		if (array_key_exists('color', $kwarg))
			$this->_color = $kwarg['color'];
		else
			$this->_color = new Color(array('rgb' => 0xffffff));
		if (Vertex::$verbose == true)
			print($this . ' constructed' . PHP_EOL);
		return;
	}

	public function	__destruct(){
		if (Vertex::$verbose == true)
			print($this . ' destructed' . PHP_EOL);
		return;
	}

	public function	__toString(){
		if (Vertex::$verbose == true)
			return (sprintf("Vertex( x: %.2lf, y: %.2lf, z: %.2lf, w:%.2lf, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color));
		else
			return (sprintf("Vertex( x: %.2lf, y: %.2lf, z: %.2lf, w:%.2lf )", $this->_x, $this->_y, $this->_z, $this->_w));
	}

	static public function	doc(){
		return (file_get_contents("Vertex.doc.txt"));
	}
}

?>
