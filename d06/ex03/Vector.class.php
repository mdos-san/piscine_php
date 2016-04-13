<?php

class	Vector{
	
	static	$verbose = false;

	private	$_x;
	private	$_y;
	private	$_z;
	private	$_w;

	public function	get_x() { return ($this->_x); }
	public function	get_y() { return ($this->_y); }
	public function	get_z() { return ($this->_z); }
	public function	get_w() { return ($this->_w); }

	public function	doc() { return (file_get_contents("Vector.doc.txt")); }

	public function	__construct(array $kwarg){
		$dest = $kwarg['dest'];
		if (array_key_exists('orig', $kwarg))
			$orig = $kwarg['orig'];
		else
			$orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
		$this->_x = $dest->get_x() - $orig->get_x();
		$this->_y = $dest->get_y() - $orig->get_y();
		$this->_z = $dest->get_z() - $orig->get_z();
		$this->_w = $dest->get_w() - $orig->get_w();
		if (Vector::$verbose == true)
			print($this . ' constructed' . PHP_EOL);
		return;
	}

	public function	__destruct(){
		if (Vector::$verbose == true)
			print($this . ' destructed' . PHP_EOL);
		return;
	}

	public function	__toString(){
		return (sprintf("Vector( x: %.2lf, y: %.2lf, z: %.2lf, w: %.2lf )", $this->get_x(), $this->get_y(), $this->get_z(), $this->get_w()));
	}

	public function	magnitude(){
		return (sqrt(pow($this->get_x(), 2) + pow($this->get_y(), 2) + pow($this->get_z(), 2) + pow($this->get_w(), 2)));
	}

	public function	normalize(){
		$mag = $this->magnitude();
		$x = $this->get_x() / $mag;
		$y = $this->get_y() / $mag;
		$z = $this->get_z() / $mag;
		return (new Vector(array('dest' => new Vertex(array('x' => $x, 'y' => $y, 'z' => $z)))));
	}

	public function	add(Vector $rhs){
		$x = $this->get_x();
		$y = $this->get_y();
		$z = $this->get_z();
		return (new Vector(array('dest' => new Vertex(array('x' => $x + $rhs->get_x(), 'y' => $y + $rhs->get_y(), 'z' => $z + $rhs->get_z())))));
	}

	public function	sub(Vector $rhs){
		$x = $this->get_x();
		$y = $this->get_y();
		$z = $this->get_z();
		return (new Vector(array('dest' => new Vertex(array('x' => $x - $rhs->get_x(), 'y' => $y - $rhs->get_y(), 'z' => $z - $rhs->get_z())))));
	}

	public function	opposite(){
		$x = $this->get_x();
		$y = $this->get_y();
		$z = $this->get_z();
		return (new Vector(array('dest' => new Vertex(array('x' => -$x, 'y' => -$y, 'z' => -$z)))));
	}

	public function	scalarProduct($k){
		$x = $this->get_x();
		$y = $this->get_y();
		$z = $this->get_z();
		return (new Vector(array('dest' => new Vertex(array('x' => $x * $k, 'y' => $y * $k, 'z' => $z * $k)))));
	}

	public function	dotProduct(Vector $rhs){
		$x = $this->get_x();
		$y = $this->get_y();
		$z = $this->get_z();
		$w = $this->get_w();
		return ($x * $rhs->get_x() + $y * $rhs->get_y() + $z * $rhs->get_z());
	}

	public function	cos(Vector $rhs){
		return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
	}

	public function	crossProduct(Vector $rhs){
		$x = $this->get_y() * $rhs->get_z() - $this->get_z() * $rhs->get_y();
		$y = $this->get_z() * $rhs->get_x() - $this->get_x() * $rhs->get_z();
		$z = $this->get_x() * $rhs->get_y() - $this->get_y() * $rhs->get_x();
		return (new Vector(array('dest' => new Vertex(array('x' => $x, 'y' => $y, 'z' => $z)))));
	}
}
?>
